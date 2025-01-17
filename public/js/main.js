/*!Main Css v1.54 by @Prem */

document.querySelectorAll('.Wishlist').forEach(function(wishlist) {
    wishlist.addEventListener('click', function() {
        const productSlug = this.getAttribute('data-url'); // Extract the slug from the URL
        const userId = this.getAttribute('data-auth');

        const productId = this.getAttribute('data-id');
        const producttype = this.getAttribute('data-type');
    
    if (!userId) {
        alert('You must be logged in to add to the wishlist.');
        return;
    }

    
    // Send a POST request to the server to add the item to the wishlist
    fetch('/development/morgan/web/wishlist', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_slug: productSlug,
            product_id: productId,
            product_type: producttype,
        })
    })
    .then(response => response.json())
    .then(data => {
        // Toggle the heart icons based on the response
     // Check the server response and update the wishlist icon accordingly
if (data.message === 'Product added to wishlist!') {
    // Hide the outlined heart icon and display the filled heart icon
    const heartOutlined = this.querySelector('.heart-o-icon');
    const heartFilled = this.querySelector('.heart-icon');
    
    if (heartOutlined && heartFilled) { // Ensure elements exist to avoid errors
        heartOutlined.style.setProperty('display', 'none', 'important'); // Use !important
        heartFilled.style.setProperty('display', 'inline', 'important'); // Use !important
    } else {
        console.error('Heart icons not found in the DOM.');
    }
} else if (data.message === 'Product removed from wishlist!') {
    // Hide the filled heart icon and display the outlined heart icon
    const heartOutlined = this.querySelector('.heart-o-icon');
    const heartFilled = this.querySelector('.heart-icon');
    
    if (heartOutlined && heartFilled) { // Ensure elements exist to avoid errors
        heartOutlined.style.setProperty('display', 'inline', 'important'); // Use !important
        heartFilled.style.setProperty('display', 'none', 'important'); // Use !important
    } else {
        console.error('Heart icons not found in the DOM.');
    }
} else {
    // Handle unexpected messages or errors
    console.warn('Unexpected message:', data.message);
}

        

    });
    });
});

// document.querySelector('.Wishlist').addEventListener('click', function() {
    
// });


(function() {
    // Get all images on the page
    const images = document.querySelectorAll('img');
    
    // Iterate through each image
    images.forEach(img => {
        // Check if the image has an alt attribute
        if (!img.hasAttribute('alt') || img.alt.trim() === '') {
            // Add or update the alt attribute
            img.setAttribute('alt', 'morgan');
            // console.log(`Alt attribute added to:`, img);
        }
    });

    console.log('Alt attribute check completed.');
})();


var owl = $("#instructor-slider");
owl.owlCarousel({
    margin: 20,
    items: 4,
    dots: false,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: false,
            items: 1.5,
        },
        600: {
            dots: false,
            items: 2.5,
        },
        1000: {
            dots: false,
            items: 4,
        },
    },
});




var owl = $("#NewDevelopment");
owl.owlCarousel({
    margin: 20,
    items: 4,
    dots: false,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: false,
            items: 1.3,
            margin: 10
        },
        600: {
            dots: false,
            items: 2.5,
        },
        1000: {
            dots: false,
            items: 4,
        },
    },
});



var owl = $("#private-office");
owl.owlCarousel({
    margin: 10,
    items: 4,
    dots: false,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: false,
            items: 1.5,
        },
        600: {
            dots: false,
            items: 2.5,
        },
        1000: {
            dots: false,
            items: 4,
        },
    },
});



var owl = $("#Brands");
owl.owlCarousel({
    margin: 20,
    items: 5,
    dots: false,
    autoplay: true,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: false,
            items: 3,
        },
        600: {
            dots: false,
            items: 3,
        },
        1000: {
            dots: false,
            items: 5,
        },
    },
});

var owl = $("#Top-Destinations");
owl.owlCarousel({
    margin: 20,
    items: 4,
    dots: false,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: true,
            items: 1,
        },
        600: {
            dots: true,
            items: 1,
        },
        767: {
            dots: true,
            items: 2,
        },
        1000: {
            dots: true,
            items: 2,
        },
    },
});



var owl = $("#Testimonials");
owl.owlCarousel({
    margin: 30,
    items: 1,
    dots: true,
    loop: true,
    nav: true,
    autoHeight: true,
    responsive: {
        0: {
            dots: true,
            items: 1,
        },
        600: {
            dots: true,
            items: 2,
        },
        1000: {
            dots: true,
            items: 3,
        },
    },
});




var owl = $("#region-slider");
	owl.owlCarousel({
		margin: 30,
		items: 3.4,
		dots: false,
		loop: true,
		nav: true,
		autoHeight: true,
		responsive: {
			0: {
				items: 1.2,
				margin: 10,
			},
			600: {
				items: 2.5,
			},
			1000: {
				items: 3.4,
			},
		},
	});



var owl = $("#team-slider");
	owl.owlCarousel({
		margin: 30,
		items: 3.4,
		dots: false,
		loop: true,
		nav: true,
		autoHeight: true,
		responsive: {
			0: {
				items: 1.2,
				margin: 10,
			},
			600: {
				items: 2.5,
			},
			1000: {
				items: 3.4,
			},
		},
	});





var owl = $("#testimonials");
	owl.owlCarousel({
		margin: 0,
		items: 1,
		dots: true,
		loop: true,
		nav: true,
		autoHeight: true,
		responsive: {
			0: {
				items: 1,
			},
			600: {
				items: 1,
			},
			1000: {
				items: 1,
			},
		},
	});













(function($) {

    $(".nav-btn.nav-slider").on("click", function() {
        $(".overlay").show();
        $(".sidebar").toggleClass("open");
    });

    $(".overlay").on("click", function() {
        if ($(".sidebar").hasClass("open")) {
            $(".sidebar").removeClass("open");
        }
        $(this).hide();
    });
    $(".overlay-body").on("click", function() {
        if ($(".sidebar").hasClass("open")) {
            $(".sidebar").removeClass("open");
        }
        $(this).hide();
    });

    $(".filterButoon").on("click", function() {
        $(".overlay-body").show();
        $(".Products-Sidebar").toggleClass("open-filter");
    });

    $(".overlay-body").on("click", function() {
        if ($(".Products-Sidebar").hasClass("open-filter")) {
            $(".Products-Sidebar").removeClass("open-filter");
        }
        $(this).hide();
    });

})(jQuery);




/*---- Bottom To Top Scroll Script ---*/
$(window).on('scroll', function() {
    var height = $(window).scrollTop();
    if (height > 600) {
        $('#back2Top').fadeIn();
    } else {
        $('#back2Top').fadeOut();
    }
});




$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".header").addClass("header-fixed");
    } else {
        $(".header").removeClass("header-fixed");
    }
});



// range slider rent page
 const rangeInput = document.querySelectorAll(".range-input input"),
				  priceInput = document.querySelectorAll(".price-input input"),
				  range = document.querySelector(".slider .progress");
				let priceGap = 1000;

				priceInput.forEach((input) => {
				  input.addEventListener("input", (e) => {
					let minPrice = parseInt(priceInput[0].value),
					  maxPrice = parseInt(priceInput[1].value);

					if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
					  if (e.target.className === "input-min") {
						rangeInput[0].value = minPrice;
						range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
					  } else {
						rangeInput[1].value = maxPrice;
						range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
					  }
					}
				  });
				});

				rangeInput.forEach((input) => {
				  input.addEventListener("input", (e) => {
					let minVal = parseInt(rangeInput[0].value),
					  maxVal = parseInt(rangeInput[1].value);

					if (maxVal - minVal < priceGap) {
					  if (e.target.className === "range-min") {
						rangeInput[0].value = maxVal - priceGap;
					  } else {
						rangeInput[1].value = minVal + priceGap;
					  }
					} else {
					  priceInput[0].value = minVal;
					  priceInput[1].value = maxVal;
					  range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
					  range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
					}
				  });
				});
				
		// filter on rent page			
		function openNav() {
			document.getElementById("filters-sidebar").style.width = "360px";
			document.getElementById("filters-sidebar").style.right = "0px";
			document.getElementById("filter-overlay").style.display = "block";
		}

		function closeNav() {
			document.getElementById("filters-sidebar").style.width = "0";
			document.getElementById("filters-sidebar").style.right = "-400px";
			document.getElementById("filter-overlay").style.display = "none";
		}
		//document.getElementById("filter-overlay").addEventListener("click", closeNav);
		const filterOverlay = document.getElementById("filter-overlay");
if (filterOverlay) {
  filterOverlay.addEventListener("click", closeNav);
} else {
  console.warn("filter-overlay element not found.");
}

		
		
		 $(document).ready(function() {
          lightGallery(document.getElementById('aniimated-thumbnials'), {
            thumbnail: true
          });
        });



        function checkAndDownload(url, type, e) {
            if (!url) {
                // Show the modal alert
                $('#alertContent').html('Please connect with the admin regarding this document');
                $('#alertTitle').html('Document Not Found');
                $('#documentNotFound').modal('show');                
                return;
            }
            // For downloading the document
            const link = document.createElement('a');
            link.href = url;
            link.download = '';
            link.click();
        }
        
            document.addEventListener('DOMContentLoaded', function () {
		const sections = document.querySelectorAll('.parent-section');

		sections.forEach(function (section) {
		    const toggleButton = section.querySelector('.link-btn');
		    const contentDiv = section.querySelector('.show_more_content');
		    const maxHeight = 300; // Set the maximum height for the initial view, adjust as needed.

		    // Initially hide the content and show the "Show More" button
		    contentDiv.style.maxHeight = `${maxHeight}px`;
		    contentDiv.style.overflow = 'hidden';

		    toggleButton.addEventListener('click', function () {
			// Toggle content visibility
			if (contentDiv.style.maxHeight === `${maxHeight}px`) {
			    contentDiv.style.maxHeight = '20000px';  // Set a large value for smooth transition
			    toggleButton.textContent = 'Show Less';  // Change button text
			} else {
			    contentDiv.style.maxHeight = `${maxHeight}px`;  // Collapse the content
			    toggleButton.textContent = 'Show More';  // Change button text
			}
		    });
		});
	    });
