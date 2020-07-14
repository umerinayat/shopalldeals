// filterContainer
// filterBtn

$('#filterBtn').click(function() {
    $('#filterContainer').toggle();
});


$('#categoriesTrigger').on('mouseenter', function (evt) {
    $('#c-list').addClass('c-list-show');
    $('#categoriesTrigger').addClass('link-active-bg');
    console.log($('#c-list'));
});

$('#storesTrigger').on('mouseenter', function (evt) {
    $('#s-list').addClass('s-list-show');
    $('#storesTrigger').addClass('link-active-bg');
    console.log($('#c-list'));
});

$('#storesTrigger').on('mouseleave', function (evt) {
    $('#s-list').removeClass('s-list-show');
    $('#storesTrigger').removeClass('link-active-bg');
});


$('#categoriesTrigger').on('mouseleave', function (evt) {
    $('#c-list').removeClass('c-list-show');
    $('#categoriesTrigger').removeClass('link-active-bg');
});

$('#s-list').on('mouseenter', function () {
    $('#s-list').addClass('s-list-show');
    $('#storesTrigger').addClass('link-active-bg');
});

$('#s-list').on('mouseleave', function () {
    $('#s-list').removeClass('s-list-show');
    $('#storesTrigger').removeClass('link-active-bg');
});

$('#c-list').on('mouseenter', function () {
    $('#c-list').addClass('c-list-show');
    $('#categoriesTrigger').addClass('link-active-bg');
    $('.p-body').removeClass('p-body-hide');
});

$('#c-list').on('mouseleave', function () {
    $('#c-list').removeClass('c-list-show');
    $('#categoriesTrigger').removeClass('link-active-bg');
    $('.p-body').removeClass('p-body-hide'); 
});

$('.p-container').on('mouseenter', function (evt) {
    console.log($(this).data('target'));
    $('#categoriesTrigger').addClass('link-active-bg');
    $('#' + $(this).data('target')).addClass('p-body-show');
    
});

$('.p-container').on('mouseleave', function (evt) {
    console.log($(this).data('target'));
    $('#' + $(this).data('target')).removeClass('p-body-show');
    
});



// Mobile Nav
// Global JS goes here

// NAVIGATION: OFF CANVAS

var $navTrigger = $('.nav-trigger');
console.log($navTrigger);
$navTrigger.on('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    $('.nav-block').toggleClass('nav-block-open');
});

$('.nav-block').on('click', function (e) {
    e.stopPropagation();
});

$(window).on('click', function (e) {
    $('.nav-block').removeClass('nav-block-open');
});


// NAVIGATION: Multilevel
var menuContainer = document.querySelector('#menu-container')


var multiLevelMenuItemsNames = document.querySelectorAll('.multi-level span');
console.log(multiLevelMenuItemsNames);

for (i = 0; i < multiLevelMenuItemsNames.length; i++) {
    multiLevelMenuItemsNames[i].addEventListener('click', handleMultiLevelItemClick);
}


function handleMultiLevelItemClick (evt) {
    var mItemBody = getMultiLevelMenuBody(evt.target.getAttribute('data-toggle')); 
    toggleMultiLevelMenuBody(mItemBody);
}

function getMultiLevelMenuBody (id) {
    var mItemBody = document.querySelector('#' + id);
    return mItemBody;
}

function toggleMultiLevelMenuBody (mItemBody) {
    if (mItemBody.style.display == 'block') {
        mItemBody.style.display = 'none';
    } else {
        mItemBody.style.display = 'block';
    }
}



// footer
var $footerSection = $('#footerSection');
var $showFooterBtn = $('#showFooterBtn');

$showFooterBtn.on('click', function(e) {
    if ($footerSection.css('visibility') == 'visible') {
        $('#footerSection').css('visibility', 'hidden');
    } else {
        $('#footerSection').css('visibility', 'visible');
    }
}); 

// toastr
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "1500",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

// copy code

hanldeCopyCode = function(event) {
    console.log($(event.target).parent().parent());

    var clipboard = new ClipboardJS($(event.target).parent().parent()[0], {
        text: function(trigger) {
            return trigger.getAttribute('data-code');
        }
    });

    clipboard.on('success', function(e) {
    
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
    
       
        toastr.remove();
        toastr.success('Copied: ' +  e.text);
    
        e.clearSelection();
    });
    
    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });

    ($(event.target).parent().parent()[0]).click();
}

hanldeCouponCode = function(event) {
    console.log($(event.target).parent().parent());

    var clipboard = new ClipboardJS($(event.target).parent().parent()[0], {
        text: function(trigger) {
            return trigger.getAttribute('data-code');
        }
    });

    clipboard.on('success', function(e) {
    
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);
    
       
        toastr.remove();
        toastr.success('Copied: ' +  e.text);
    
        e.clearSelection();
    });
    
    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });

    ($(event.target).parent().parent()[0]).click();
}


