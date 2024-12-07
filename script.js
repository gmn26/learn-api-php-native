function fetch() {
    $.ajax({
        url: "http://learn-api-php-native.test/api/categories.php",
        method: "GET",
        success: (resp) => {
            if (resp.data == null) {
                $("#data").html(`
                    <td colspan="3">
                    Data Kosong
                    </td>
                    `);
            } else {
                $("#data").html("");
                resp.data.forEach((item, index) => {
                    $("#data").append(`
                        <td>
                        ${++index}
                        </td>
                        <td>
                        ${item.name}
                        </td>
                        <td>
                        Tombol
                        </td>
                        `);
                });
            }
        },
        error: (resp) => {
            console.table(resp);
        },
    });
}

$("#add_category").click(function () {
    const name = $("#name").val();
    $.ajax({
        url: "http://learn-api-php-native.test/api/categories.php",
        method: "POST",
        data: {
            "nama": name,
        },
        success: (resp) => {
            console.log(resp);
        },
        error: (resp) => {
            console.log(resp);
        }
    })
})

$(document).ready(() => {
    fetch();
});