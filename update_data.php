<?php
include 'config.php';
$query = mysqli_query($conn, "SELECT * FROM `Kamera1`");
?>

<body>
    <table border="1">
        <?php $no = 1; ?>
        <?php foreach ($query as $data) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $data['upload_time']; ?></td>
                <td>
                    <a href="show.php?id=<?= $data['id']; ?>">Details</a> |
                    <a href="delete.php?id=<?= $data['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>