function getInstagram(id) {
    $.ajax({
        url: 'https://www.instagram.com/' + id + '?__a=1',
        type: 'get',

        success: function (response) {
            console.log(response.graphql)

            posts = response.graphql.user.edge_owner_to_timeline_media.edges;
            posts_html = '';
            is_private = response.graphql.user.is_private;

            if (is_private === true) {
                $("#private").css("display", "none");
            } else {
                $("#private").css("display", "block");
            }

            if (Array.isArray(posts) && posts.length) {
                for (var i = 0; i < 4; i++) {
                    url = posts[i].node.display_url;
                    posts_html += '' +
                        '<div class="col-md-3">' +
                        '<img style="max-height:200%; width:100%; cursor: pointer" src="' + url + '" onclick="onClick(this)">' +
                        '</div></div>';
                }
            }
            $(".posts").html(posts_html);
        },
        error: function (xhr) {
            if (xhr.status === 404) {
                $("#private").css("display", "none");
            }
        },
    });
}

function portfolio(images) {
    'use strict';
    let slides = images,

        currentSlide = 0,
        elSlide = document.getElementById('slide'),
        elSlide2 = document.getElementById('slide2'),
        elPrev = document.getElementById('prev-slide'),
        elNext = document.getElementById('next-slide'),

        showSlide = function (index) {
            if (index > -1 && index < slides.length) {
                currentSlide = index;
                elSlide.src = slides[index];
                elSlide.className = 'img-holder';
                elSlide2.className = 'img-holder';

                elPrev.classList.remove('disabled');
                elNext.classList.remove('disabled');

                if (index === 0) {
                    elPrev.classList.add('disabled');
                } else if (index === slides.length - 1) {
                    elNext.classList.add('disabled');
                }
                if (index !== slides.length - 1) {
                    elSlide2.src = slides[++index];
                } else {
                    elSlide2.src = "";
                }
            }
        },

        changeSlide = function (step) {
            let index = currentSlide + step;
            showSlide(index);
        },
        prevSlide = changeSlide.bind(null, -2),
        nextSlide = changeSlide.bind(null, 2);

    elPrev.addEventListener('click', prevSlide, false);
    elNext.addEventListener('click', nextSlide, false);

    showSlide(0);
}

function onClick(element) {
    document.getElementById("modalImg").src = element.src;
    document.getElementById("modalId").style.display = "block";
}

function gallery(images) {
    function isOdd(num) {
        return num % 2;
    }

    if (images) {
        for (let i = 1; i < images.length; i++) {
            $("#model" + (i + 1)).hide();

            if (i === 1) {
                $('#model1').click(function () {
                    $('#model1').toggle();
                    $('#model2').show();
                    $('#model3').show();
                });
            }

            if (isOdd(i) === 0) {
                (function (j) {
                    $("#model" + j).click(function () {
                        $("#model" + (j - 2)).show();
                        $("#model" + (j - 1)).show();
                        $("#model" + (j)).toggle();
                        $("#model" + (j + 1)).toggle();
                    });
                    $("#model" + (j + 1)).click(function () {
                        $("#model" + (j + 2)).show();
                        $("#model" + (j + 3)).show();
                        $("#model" + (j + 1)).toggle();
                        $("#model" + (j)).toggle();
                    });

                })(i)
            }
        }
        let fingallerie = images.length;
        $('#model' + fingallerie).click(function () {
            $('#model' + fingallerie).toggle();
            $('#model' + (fingallerie - 1)).show();
            $('#model' + (fingallerie - 2)).show();
        });


    }
}