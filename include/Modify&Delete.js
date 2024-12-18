/* Lama Al-Ghamdi - 2190002418 */

function onDelete(id) {
    var conf;
    conf = window.confirm("Are you sure you want to delete this product?");

    if (conf) {
        document.location.href = "Admin Home.php?id=" + id + "&action=delete";
    }
}

function onModify(id) {
    var conf;
    conf = window.confirm("Are you sure you want to Modify this product?");

    if (conf) {
        document.location.href = "Modify Products.php?id=" + id;
    }
}