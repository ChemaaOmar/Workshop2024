// script.js
$(document).ready(function(){
    var categories = [
        { name: "Facebook", icon: "facebook-icon.png" },
        { name: "Instagram", icon: "instagram-icon.png" },
        { name: "X", icon: "x-icon.png" },
        { name: "TikTok", icon: "tiktok-icon.png" }
    ];
    var currentIndex = 0;

    function updateIcons() {
        $('.social-icons img').attr('src', categories[currentIndex].icon);
    }

    $('#prevBtn').click(function(){
        if (currentIndex > 0) {
            currentIndex--;
            updateIcons();
        }
        checkButtons();
    });

    $('#nextBtn').click(function(){
        if (currentIndex < categories.length - 1) {
            currentIndex++;
            updateIcons();
        }
        checkButtons();
    });

    $(document).ready(function() {
        $('#burgerMenu').click(function() {
            $('#menu').toggleClass('show');
        });
    });
    

    function checkButtons() {
        if (currentIndex === 0) {
            $('#prevBtn').attr('disabled', true);
        } else {
            $('#prevBtn').attr('disabled', false);
        }

        if (currentIndex === categories.length - 1) {
            $('#nextBtn').attr('disabled', true);
        } else {
            $('#nextBtn').attr('disabled', false);
        }
    }

    // Initial state
    updateIcons();
    checkButtons();
});
