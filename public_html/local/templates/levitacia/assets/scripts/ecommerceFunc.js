function eComAddToBasketE(elem) {
    console.log(elem)
    var product_id = $('.good div:eq(0)').attr('id');
    var product = window['ob' + product_id];
    if (product) {
        let price = 0;
        if(product.offers[0]){
            price = product.offers[0].ITEM_PRICES[0].BASE_PRICE;
        }else{
            price = product.currentPrices[0].BASE_PRICE;
        }

        let variant = '';

        if (product.selectedValues.PROP_23 && product.treeProps[0]) {
            variant = product.treeProps[0].VALUES[product.selectedValues.PROP_23].NAME;
        }
        if (product.selectedValues.PROP_24 && product.treeProps[1]) {
            if (variant) {
                variant += ', '+product.treeProps[1].VALUES[product.selectedValues.PROP_24].NAME;
            }else {
                variant = product.treeProps[1].VALUES[product.selectedValues.PROP_24].NAME;
            }

        }
        dataLayer.push({
            "ecommerce": {
                "add": {
                    "products": [{
                        "id": product.product.id,
                        "name": product.product.name,
                        "variant": variant,
                        "category": product.product.category,
                        "price": price,
                        "quantity": 1
                    }]
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Add to Cart',
            'gtm-ee-event-non-interaction': 'False',
        });
        console.log(dataLayer)
    }
}

function gaSendOrder(elem){
    //console.log(elem);
}

$(document).on('click', '.basket-content-bot__checkout', function (e) {
    var products = [];
    var purcaseSum = $('.basket-content-total-row__price').text().replace(/[^\d;]/g, '');
    localStorage.setItem('purcaseSum', purcaseSum);
    console.log($(window.BX.Sale.BasketComponent.result));
    if(window.BX.Sale.BasketComponent.result.BASKET_ITEM_RENDER_DATA.length && !localStorage.getItem('itemDelTrue')){
        $(window.BX.Sale.BasketComponent.result.BASKET_ITEM_RENDER_DATA).each(function(indx, element) {
            let variant = '';
            let size = '';
            if(element.PROPS[0]){variant = element.PROPS[0].VALUE;}
            if(element.PROPS[1]){size = element.PROPS[1].VALUE;}
            products.push({
                "id": element.ID,
                "name": element.NAME,
                "quantity": element.QUANTITY,
                "price": element.PRICE,
                "variant": variant,
                "size": size
            });
        });
    } else {
        $('tr.basket-content-row').each(function (index, elem) {
            let name = $(elem).find('.basket-content-row-col__title span:eq(0)').text();
            if (name.length != 0) {
                products.push({
                    "id": $(elem).data('id'),
                    "name": name,
                    "quantity": $(elem).find('.basket-content-row-col__input').val(),
                    "price": $(elem).find('.basket-item-price-current-text:eq(1)').text().replace(/[^\d;]/g, ''),
                    "variant": $(elem).find('.basket-content-row-col__title li[data-initial="true"]').text().replace(/\s+/g,''),
                });
            }
        });
        localStorage.removeItem('itemDelTrue');
    }
    localStorage.setItem('products', JSON.stringify(products));
});
$(document).on('click', '.basket-content-row-col__del', function (e) {
    let product_id = $(this).parents('tr').data('id');
    var products = [];
    $(window.BX.Sale.BasketComponent.result.BASKET_ITEM_RENDER_DATA).each(function(index, element) {
        let id = element.ID;
        if(+id === product_id){
            let price = element.PRICE;
            let name = element.NAME;
            let quantity = element.QUANTITY;

            let variant = '';
            element.PROPS.forEach(function(item, i){
                if (i === 0) {variant += item.VALUE;} else {variant += ', '+item.VALUE;}
            });

            products.push({
                "id": id,
                "name": name,
                "quantity": quantity,
                "price": price,
                "variant": variant
            });
            localStorage.setItem('itemDelTrue', '1');
            /*localStorage.setItem('del_'+id, JSON.stringify(products));*/
            return false;
        }
    });
    dataLayer.push({
        "ecommerce": {
            "remove": {
                "products": products
            }
        },
        'event': 'gtm-ee-event',
        'gtm-ee-event-category': 'Enhanced Ecommerce',
        'gtm-ee-event-action': 'Remove from Cart',
        'gtm-ee-event-non-interaction': 'False',
    });
});

/*
var products = [];
console.log(window.BX.Sale.BasketComponent.result.BASKET_ITEM_RENDER_DATA);
$(window.BX.Sale.BasketComponent.result.BASKET_ITEM_RENDER_DATA).each(function(indx, element) {
    let id = element.ID;
    let price = element.PRICE;
    let name = element.NAME;
    let quantity = element.QUANTITY;

    let variant = '';
    if(element.PROPS[0]){variant = element.PROPS[0].VALUE;}

    products.push({
        "id": id,
        "name": name,
        "quantity": quantity,
        "price": price,
        "variant": variant
    });
});
console.log(products);
localStorage.setItem('products', JSON.stringify(products));*/
