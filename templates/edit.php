<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit the data of user number <?= $id ?></title>
</head>
<body>
    <h1>User <?= $id ?> editing</h1>
    <form action="/api/users/<?= $id ?>" method="POST">
        <input type="text" value="<?= $name ?>" name="name">
        <input type="text" value="<?= $phone ?>" name="phone">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit">
    </form>
</body>
</html>
