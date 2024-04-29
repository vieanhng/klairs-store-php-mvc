$(document).ready(function (){
    $.ajax({
        type: 'GET',
        url: BASE_URL + 'header/getCategories',
}).done(function (data, textStatus, jqXHR) {
        const categoriesHtml = $('#category-dropdown').html('');
        const catfooter = $('#category-dropdown-footer').html('')
        data.map(
            (item) => {categoriesHtml.append(
                `<li class="dropdown-item"><a href="${BASE_URL}categories/category/cat/${item.ma_danh_muc}">${item.ten_danh_muc}</a></li>`
            )
                catfooter.append(`<li class="dropdown-item"><a href="${BASE_URL}categories/category/cat/${item.ma_danh_muc}">${item.ten_danh_muc}</a></li>`)
            }
        )

    }).fail(function (jqXHR, textStatus, errorThrown) {

    });
})