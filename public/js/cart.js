$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function(e){
        e.preventDefault();
        let cartID = $(this).data("id");


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cart/delete',
            method: 'DELETE',
            dataType: "json",
            data: {
                deleteBtn: true,
                cartID: cartID
            },
            success: function(data){
                refreshAmount()

                refreshView();
                refreshCartNumber();

            },
            error: function(xhr, status, statusText){
                console.error('----> ERROR <----');
                console.log(statusText);

            }
        });
    });

    $(document).on('click', '#buyBtn', function(e){
        e.preventDefault();


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/cart/buy',
            method: 'DELETE',
            dataType: "json",

            success: function(data){
                refreshAmount();
                refreshView();
                refreshCartNumber();
            },
            error: function(xhr, status, statusText){
                console.error('----> ERROR <----');
                console.log(statusText);

            }
        });
    });







});


function refreshAmount(){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/cart/amount",
        method: "GET",
        dataType: "json",
        success: function(data){
            let html="";

                html += `<h4 class="text-right ml-3">Ukupno: <strong>${(data == null) ? 0 : data} din</strong></h4>`;

            $("#price").html(html);
        }

    })
}

function refreshView() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/cart/tools',
        method: 'GET',
        dataType: "json",

        success: function(data){
            printProducts(data);
        },
        error: function(xhr, status, statusText){
            console.error('----> ERROR <----');
            console.log(statusText);
        }
    })
}
function printProducts(data){

    let html="";
    for(let tool of data){
        html += `<div class="row" style="margin-left: 250px;">
                            <div class="col-lg-3">
                                <img class="img-responsive" style="width: 200px; height: 200px; " src="/img/tools/${ tool.imgSrc }" >
                            </div>
                            <div class="col-lg-5">

                                <h5 class="product-name ml-5">
                                    <strong>${ tool.name }</strong>
                                </h5>
                                <h5 class="ml-5">
                                    <small>${ tool.description }</small>
                                </h5>
                            </div>

                             <div class="col-lg-2">


                               <h6> <del><strong class="ml-2 mt-4 text-danger">Cena: ${ tool.price } dinara</strong> </del></h6><br>
                                   <h6><strong class="ml-2 mt-4 ">Cena na sajtu: ${ tool.sitePrice } dinara</strong> </h6>
                           </div>

                            <a href="#" class="ml-5 deleteBtn" data-id="${ tool.cartID }"><i class="far fa-trash-alt fa-lg"></i></a>

                        </div> `;
    }
    $("#tools1").html(html);
}
