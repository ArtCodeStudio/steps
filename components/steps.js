/*
 * 2do: Validation 
 *
 ***************************************************************************/

function JumplinkSteps() {

    var _currentPrice = $('#currentPrice');
    var _d = $(document);
    
    var currentPrice = 0;
    var priceLimit = 0; 
    // var serviceSelection = $("#serviceSelection input");
    // var webpageModuleSelection = $("#webpageModuleSelection input");

    var modules = {
        blog: {
            selected: false,
            price: 100
        },
        contactForm: {
            selected: false,
            price: 100
        },
        forum: {
            selected: false,
            price: 100
        }
        // },
        // shop: {
        //     selected: false,
        //     price: 100
        // },
    };

    var checkPriceLimit = function() {
        console.log('limit?: ', currentPrice , priceLimit );
        if( currentPrice > priceLimit &&  priceLimit > 0  ) {
            console.log('alert!');
            _currentPrice.css('color', 'red');
        }else{
            _currentPrice.css('color', 'black');
        }
    }

    var updatePrice = function () {
        //var price = parseInt( currentPrice.html() ); // aktueller preis
        //currentPrice.html( currentPrice += value ); 
        currentPrice = 0;
        $.each(modules, function( index, object){  
            if(object.selected) {
                currentPrice += object.price;
                // console.log(index, object.price);
            }
        });
        _currentPrice.html("Euro: " + currentPrice);
        checkPriceLimit();
    }


    _d.on("keyup", priceLimit, function(e) { // Kunden Preislimit
        console.log(e.target.value);//$("#priceLimit");
        priceLimit = e.target.value;
    });


    /*
    * Show Second Step (Service  Selection,)
    */
    _d.on("change", ".serviceSelection", function(e) { 
        console.log('serviceSelection ', $(e.target).val());
        var val = $(e.target).val();
        var app = $(".appServiceContainer");
        var web = $(".webpageServiceContainer");
        var shop = $(".shopServiceContainer");
        
        app.hide();
        web.hide();
        shop.hide();

        switch(val) {
            case 'app': app.show(); break;
            case 'onlineshop': shop.show(); break;
            case 'webpage': web.show(); break;
        }
       
    });


    _d.on("change", '.webpageModuleSelection', function(e) { 
        // console.log("webpageModuleSelection",e.target.checked );
        var currentValue = $(e.target).val();
        modules[currentValue].selected = e.target.checked;
        updatePrice();
        console.log(modules);
    });


    _d.on("click", "#checkDomainButton", function(e) {
        e.preventDefault();
        var domainInput = $("#domainInput").val();
        $.request('onCheckDomain', {
                data: {"domainInput": domainInput },
                success: function(data) {
                    // console.log('success:', data);
                    this.success(data).done( function(e) {
                        if(data.result===1){
                            console.log('available');
                            $("#domainAvailable").show();
                             $("#domainNotAvailable").hide();
                        }else{
                            $("#domainAvailable").hide();
                            $("#domainNotAvailable").show();
                             console.log('notavailable');
                        }
                       
                    });
                }
            });
    });

            // form.request('onDoit', {
            //     success: function(data) {
            //         // console.log('inline success!', data);
            //         this.success(data).done( function() {
            //            console.log('inline success!', data);
            //            $.oc.stripeLoadIndicator.hide();
            //            showResult(data);
            //         });
            //     }
            // });


    $('#jumplink_steps').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        transitionEffect: 'slideLeft',
        autoFocus: true,
        startIndex: 2,
        onStepChanging: function(){
            console.log('before step change!');
            /*get selected values*/
            return true; //return false to block (validation false?)
            
        },
        
        onStepChanged: function() {
            //console.log('step changed', current_state);

        }
    });


}
JumplinkSteps();

$(".webpageServiceContainer").show();