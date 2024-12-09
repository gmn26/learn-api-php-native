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
                        <button id="${item.id}" onclick="deleteItem(this.id)">Delete</button>
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

// $("#add_category").click(function () {
//     const name = $("#name").val();
//     $.ajax({
//         url: "http://learn-api-php-native.test/api/categories.php",
//         method: "POST",
//         data: {
//             "nama": name,
//         },
//         success: (resp) => {
//             console.log(resp);
//         },
//         error: (resp) => {
//             console.log(resp);
//         }
//     })
// })

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