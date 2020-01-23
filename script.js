$(document).ready(function() {
    $('#nivea-form #add-more').on('click', function() {
        $receipts = $(this).parent().find(".row-receipt").last();

        $receipts = $receipts.clone();
        $receipts.hide();
        $receipts.insertBefore($(this));


        $last_receipt = $(this).parent().find(".row-receipt").last();
        $last_receipt.fadeIn('slow');
        $last_receipt.find('.close').removeClass('hide');

        $total = $('#nivea-form .row-receipt').length
        $('#nivea-form .row-receipt').last().find('.receipt').attr('name', 'receipt_no_' + $total);
        $('#nivea-form .row-receipt').last().find('.receipt').val('');
        $('#nivea-form .row-receipt').last().find('.receipt').removeClass('form-control-danger');
        $('#nivea-form .row-receipt').last().find('.file').attr('name', 'receipt_pic_' + $total);
        $('#nivea-form .row-receipt').last().find('.file').val = '';
        $('#nivea-form .row-receipt').last().find('label').attr('for', 'receipt_pic_' + $total);
        $('#nivea-form .row-receipt').last().find('.file').attr('id', 'receipt_pic_' + $total);
        $('#nivea-form .row-receipt').last().find('span.file_name').text('No file choosen');
        $('#nivea-form .row-receipt').last().find('span.error').remove();
        $('#nivea-form .row-receipt').last().removeClass('error-bg');

        $('#nivea-form .row-receipt .close').on('click', function() {
            $(this).parent().fadeOut('slow').remove();
        });

        $('#nivea-form .row-receipt input.receipt').keyup( function() {
            $current = $(this).val();
            $dup = 0;
    
            $('#nivea-form .row-receipt').each( function() {
                $value = $(this).find('input.receipt').val();
                if ($current === $value) {
                    $dup++;
                }
            })
    
            if ($dup > 1) {
                $(this).addClass('form-control-danger');
            } else {
                $(this).removeClass('form-control-danger');
            }
        })

        $('#nivea-form .row-receipt input[type="file"]').change( function() {
            if ($(this).val() === "") {
                $(this).parent().find('.file_name').text('No file choosen')
            }
            else {
                $(this).parent().find('.file_name').text($(this).val().replace(/^.*\\/, ''))
            }
        })
    });

    $('#nivea-form .row-receipt').each(function() {
        if ($(this).find('span.error').length > 0) {
            $(this).addClass('error-bg');
        } else {
            $(this).removeClass('error-bg');
        }
    })

    $('#nivea-form .row-receipt input[type="file"]').change( function() {
        if ($(this).val() === "") {
            $(this).parent().find('.file_name').text('No file choosen')
        }
        else {
            $(this).parent().find('.file_name').text($(this).val().replace(/^.*\\/, ''))
        }
    })
    // $('#butsave').on('click', function() {
    //     $("#butsave").attr("disabled", "disabled");
    //     var name = $('#name').val();
    //     var email = $('#email').val();
    //     var phone = $('#phone').val();
    //     var city = $('#city').val();
    //     if(name!="" && email!="" && phone!="" && city!=""){
    //         $.ajax({
    //             url: "save.php",
    //             type: "POST",
    //             data: {
    //                 name: name,
    //                 email: email,
    //                 phone: phone,
    //                 city: city				
    //             },
    //             cache: false,
    //             success: function(dataResult){
    //                 var dataResult = JSON.parse(dataResult);
    //                 if(dataResult.statusCode==200){
    //                     $("#butsave").removeAttr("disabled");
    //                     $('#fupForm').find('input:text').val('');
    //                     $("#success").show();
    //                     $('#success').html('Data added successfully !'); 						
    //                 }
    //                 else if(dataResult.statusCode==201){
    //                     $("#error").show();
    //                     $('#error').html('Email ID already exists !');
    //                 }
                    
    //             }
    //         });
    //     }
    //     else{
    //         alert('Please fill all the field !');
    //     }
    // });
});
