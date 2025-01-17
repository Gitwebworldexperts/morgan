
// function initTinyMCE() {
//     tinymce.init({
//         selector: 'textarea', // Targets all textareas
//         plugins: [
//             // Core editing features
//             'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link',
//             'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
//             // Premium features
//             'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed',
//             'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable',
//             'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments',
//             'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography',
//             'inlinecss', 'markdown',
//         ],
//         toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
//         tinycomments_mode: 'embedded',
//         tinycomments_author: 'Author name',
//         mergetags_list: [{
//                 value: 'First.Name',
//                 title: 'First Name'
//             },
//             {
//                 value: 'Email',
//                 title: 'Email'
//             },
//         ],
//         ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
//             'See docs to implement AI Assistant')),
//     });
// }


function previewImage(event, input) {
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        const img = input.nextElementSibling.querySelector('img');
        img.src = e.target.result;
        img.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}

function generateSlug() {
    const nameInput = document.getElementById('name').value;
    const slugInput = document.getElementById('slug');

    // Convert to slug format
    const slug = nameInput
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
        .replace(/\s+/g, '-') // Replace spaces with dashes
        .replace(/--+/g, '-'); // Replace multiple dashes with a single dash

    slugInput.value = slug;
}

// document.addEventListener('DOMContentLoaded', () => {
//     initTinyMCE(); // Initialize on existing textareas
// });

$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Select a country',
        allowClear: true
    });

    $('#submit_contact_form').on('click', function(e) {
        alert('hello');return 1;  
      e.preventDefault(); // Prevent the default form submission

        // Collect form data
        const formData = $(this).serialize();

        // Send the data using AJAX
        $.ajax({
            type: 'POST',
            url: '/contact', // Make sure this matches your route
            data: formData,
            success: function(response) {
                alert(response.success); // Show success message
                $('#contactForm')[0].reset(); // Reset the form
            },
            error: function(xhr) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = '';

                // Handle validation errors
                for (let key in errors) {
                    errorMessage += errors[key].join(', ') + '\n';
                }

                alert(errorMessage); // Show error messages
            }
        });
    });
});
