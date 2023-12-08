<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
include('db/class.php');
$db = new admin_class();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
    <title>The Purishmian | Admin</title>
</head>

<div class="alert text-center mt-3">
</div>

<body class="">
    <div class="admin-main-container container card mt-5 p-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="process/logout.php">Logout</a>
            </li>
        </ul>
        <div class="card  mt-3 p-1">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Article</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getArticles = $db->getArticles();
                    if ($getArticles->num_rows > 0) {
                        $count = 1;
                        while ($article = $getArticles->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><img class="article-photo" src="assets/articles/<?= $article['PHOTO'] ?>"></td>
                                <td><?= $article['CATEGORY'] ?></td>
                                <td><?= $article['TITLE'] ?></td>
                                <td><?= $article['ARTICLE'] ?></td>
                                <td>
                                    <button class="btn btn-dark btnEdit" data-id="<?= $article['ID'] ?>" data-category="<?= $article['CATEGORY'] ?>" data-title="<?= $article['TITLE'] ?>" data-article="<?= $article['ARTICLE'] ?>">
                                        <i class="fa-regular fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btnDelete" data-id="<?= $article['ID'] ?>"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php
                            $count++;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">
                                <center>No Article Found.</center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <button id="openAddArticleModal" class="btn-open-add-article-modal btn"><i class="fa-solid fa-plus"></i> Add</button>

    <!-- Add Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddModalLabel">Add new article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frmAddNewArticle" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div>
                            <label for="articleCategory">Category:</label>
                            <input type="text" id="articleCategory" name="articleCategory" class="form-control mt-1" required>
                        </div>
                        <div class="mt-3">
                            <label for="articleTitle">Title:</label>
                            <input type="text" id="articleTitle" name="articleTitle" class="form-control mt-1" required>
                        </div>
                        <div class="mt-3">
                            <label for="article">Article:</label>
                            <textarea type="text" id="article" name="article" class="form-control mt-1" required></textarea>
                        </div>
                        <div class="mt-3">
                            <label for="articlePhoto">Photo:</label>
                            <input type="file" id="articlePhoto" name="articlePhoto" class="form-control mt-1" required>
                        </div>
                        <input type="hidden" name="submitType" value="AddArticle">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnAddArticle">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Add Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditModalLabel">Edit article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frmEditArticle" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div>
                            <label for="EditArticleCategory">Category:</label>
                            <input type="text" id="EditArticleCategory" name="EditArticleCategory" class="form-control mt-1" required>
                        </div>
                        <div class="mt-3">
                            <label for="EditArticleTitle">Title:</label>
                            <input type="text" id="EditArticleTitle" name="EditArticleTitle" class="form-control mt-1" required>
                        </div>
                        <div class="mt-3">
                            <label for="EditArticle">Article:</label>
                            <textarea type="text" id="EditArticle" name="EditArticle" class="form-control mt-1" required></textarea>
                        </div>
                        <div class="mt-3">
                            <label for="articlePhoto">Change Photo:</label>
                            <input type="file" id="articlePhoto" name="articlePhoto" class="form-control mt-1">
                        </div>
                        <input type="hidden" name="articleId" id="articleId" value="">
                        <input type="hidden" name="submitType" value="EditArticle">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btnAddArticle">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Edit Modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this article?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnConfirmDelete" data-id="">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Delete Modal -->

    <script src="https://kit.fontawesome.com/c6c8edc460.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="javascript/admin.js"></script>
</body>

</html>