<!DOCTYPE html>
<html>
<head>
    <title><?php echo $getCollection::PAGE_TITLE ?></title>
    <link rel="stylesheet" href="pub/css/bootstrap.css">
    <link rel="stylesheet" href="pub/css/style.css">
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
</head>

<body>
<div class="general">
    <ul class="nav justify-content-end">
        <?php if ($collectErrors->isLoggedIn()): ?>
            <li class="nav-item">
                <a class="nav-link" href="/logout">Log out</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/register">Registration</a>
            </li>
        <?php endif; ?>
    </ul>
    <?php if ($messages = $collectErrors->getMessages()): ?>
        <div class="alert alert-warning">
            <?php echo $messages ?>
        </div>
    <?php endif; ?>
    <?php if ($collectErrors->isLoggedIn()): ?>
        <button type="button" class="btn btn-info" onclick="location.href='form'">Upload image</button>
        <form action="switchCollections" method="get" class="btn-group">
                <button type="submit" class="btn btn-info" name="display" value="all">Display all images</button>
                <button type="submit" class="btn btn-info" name="display" value="own">Display own images</button>
        </form>
    <?php endif; ?>
    <div class="contain">
        <?php if (!empty($images = $getCollection->switchCollections())): ?>
            <?php foreach ($images as $image): ?>
                <div class="image-container">
                    <div class="img-thumbnail">
                        <a data-fancybox='images' href="<?php echo $image['image_path']; ?>">
                            <img src="<?php echo $image['thumbnail_path']; ?>" />
                        </a>
                        <p>
                            Author: <?php echo $image['author_name'] ?>,</br>
                            Description: <?php echo $image['description'] ?>,</br>
                            Owner: <?php echo $image['login'] ?></br>
                            Created at: <?php echo $image['created_at'] ?></br>
                        </p>
                        <?php if ($getCollection->isLoggedIn()): ?>
                            <button type="button" class="btn btn-warning btn-block"
                                    onclick="if (confirm('Are you sure?')) {location.href = '/removeImage?id=<?php echo $image['id'] ?>';}">
                                Delete
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            </br>
            <div class="image-center">
                <img src="pub/css/BackToTheFuture.jpg" />
                <p><i>...no pictures also</i></p>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <nav>
            <ul class="pagination justify-content-center">
                <?php echo $pagination->renderPagination() ?>
            </ul>
        </nav>
    </div>
    </div>
</div>
</body>
</html>

