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
                        <tr>
                            <td>
                                ${++index}
                            </td>
                            <td>
                                ${item.name}
                            </td>
                            <td>
                                <button id="${item.id}" onclick="deleteItem(this.id)">
                                    Delete
                                </button>
                            </td>
                        </tr>
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
    const data = JSON.stringify({
        "name": name,
    });
    $.ajax({
        url: "http://learn-api-php-native.test/api/categories.php",
        method: "POST",
        data: data,
        success: (resp) => {
            console.log(resp);
            if (resp.status == "Duplicate data") {
                alert("Data telah terdaftar");
            } else {
                alert("Berhasil tambah data");
            }
            $("#name").val("");
            fetch();
        },
        error: (resp) => {
            console.error(resp);
            alert("Gagal tambah data");
        }
    })
})

function deleteItem(id) {
    $.ajax({
        url: `http://learn-api-php-native.test/api/categories.php?id=${id}`,
        method: "DELETE",
        success: (resp) => {
            alert("Berhasil hapus data");
            fetch();
        },
        error: (resp) => {
            alert("Gagal hapus data");
        }
    })
}

$(document).ready(() => {
    fetch();
});