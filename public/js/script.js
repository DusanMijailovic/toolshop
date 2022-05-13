$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
$(document).ready(function(){




loadTools();



/* SEARCH */

$("#search").keyup(function(e){
    e.preventDefault();
    let value = $("#search").val();



    $.ajax({

        url: '/search' ,
        method: 'GET',

        data: {
            value: value
        },

        success: function(data,status, xhr){

            $("#tools_paginate").html("")
            printTools(data);



        },
        error: function(xhr, status, statusText){
            console.error('----> ERROR <----');
            console.log(statusText);
        }
    })
});


$(document).on("click", ".category", function(e){
        e.preventDefault();

        let id = $(this).data("id");

        $.ajax({

            url: "/category-filter",
            method: "GET",
            data: {
                id: id
            },
            success: function(data){

                let numOflinks = Math.ceil(data.total/data.per_page);
                printPagination(numOflinks,data.path, id);
                printTools(data.data);

            },
            error: function(xhr, status, statusText){
                console.error('----> ERROR <----');
                console.log(statusText);
            }
        })
    });

    $(document).on("click", "#allTools", function(e){
        e.preventDefault();

      loadTools();
    });


    $(document).on("click", "#addToolBtn", function(e){
        e.preventDefault();
        //let userID = $("#userID").val();
        let priceSite = $("#price-site").text();
        let categoryID = $("#categoryID").val();



        $.ajax({

            url: '/cart/insert',
            method: 'POST',
            dataType: "json",
            data: {
                cartBtn: true,
                priceSite: priceSite,
                categoryID: categoryID
            },
            success: function(data){



                let alertDiv = document.querySelector('#successMessage');
                let message = document.querySelector('#msg');

                alertDiv.classList.remove('invisible');
                alertDiv.classList.add('alert-success');
                message.textContent = data.success;
                setTimeout(function () {
                    alertDiv.classList.add('invisible')
                }, 2500);
                refreshCartNumber();

            },
            error: function(xhr, status, statusText){
                console.error('----> ERROR <----');
                console.log(status);
                console.log(xhr);
                console.log(statusText);

            }
        });
    });




    $(document).on('click', '.js-pagination', function(event){
        event.preventDefault();
        let page = $(this).data('page');
        $.ajax({
            url:page,
            dataType:'json',
            method:"get",
            success:function (data) {
                printTools(data.data);

            },
            error:function (xhr,status,error) {
                alert(xhr.status)
            }
        });

    });






});


function loadTools() {
    let value = $("#search").val();
    let id = $(this).data("id");
    $.ajax({
        url:'/fetch_data',
        dataType:'json',
        method:"get",
        success:function (data) {
            let numOflinks = Math.ceil(data.total/data.per_page);
            printPagination(numOflinks,data.path,id, value);
            printTools(data.data);
        },
        error:function (xhr,status,error) {
            alert(xhr.status)
        }
    })


}


    function refreshCartNumber(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/cart/cart-number',
        method: 'GET',
        dataType: "json",

        success: function(data){
            let html="";

            html += `<i class="fas fa-shopping-cart">(${data})</i>`;

            $(".cartNumber").html(html);


        },
        error: function(xhr, status, statusText){
            console.error('----> ERROR <----');
            console.log(statusText);
        }
    })
}

function printTools(data){

    let html = "";

    for(let tool of data){
        html +=`<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="/product/${ tool.toolID }"><img class="card-img-top" src="${ '/img/tools/'+ tool.imgSrc }" ></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="/product/${ tool.toolID }" class="text-decoration-none text-muted font-weight-normal">${ tool.name }</a>
            </h4>
            <h5>${ tool.price } dinara</h5>
            <p class="card-text">${ tool.description.substring(0, 150) } </p>
        </div>
          <div class="card-footer">
            <a class="btn bg-secondary text-white font-weight-light" href="/product/${ tool.toolID }" role="button">Detaljnije</a>
        </div>
    </div>
</div> `;

    }


    $("#tools").html(html);


}

function printPagination(links, url, id ) {
    let print = `<ul class='pagination'>`
    for (let i = 1; i <= links; i++) {
        if(id){
        print += `<li class='page-item'><a href='#' class='page-link js-pagination' data-page='${url + '?id=' + id + '?page=' + i}'>${i}</a></li>` }

        else{
            print += `<li class='page-item'><a href='#' class='page-link js-pagination' data-page='${url + '?page=' + i}'>${i}</a></li>` }
    }
    print += `</ul>`


    $('#tools_paginate').html(print)

}



