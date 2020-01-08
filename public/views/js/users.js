/**
 * Submit User Profile Picture.
 */
$('.newPicture').change(function() {
  let img = this.files;
  // 2 bytes times 1000 = 2kb times 1000 = 2mb
  const twoMb = 2 * 1000 * 1000;

  if (img && img.length) {
    img = img[0];

    if (
      img.type !== 'image/jpeg' &&
      img.type !== 'image/jpg' &&
      img.type !== 'image/png'
    ) {
      $(this).val('');

      swal({
        type: 'error',
        title:
          'Image type not allowed. Please, choose an image in JPEG or PNG format.',
        showConfirmButton: true,
        confirmButtonText: 'Close',
        closeOnConfirm: true
      });
    } else if (img.size > twoMb) {
      $(this).val('');

      swal({
        type: 'error',
        title: 'Image too large. Please insert an image with at most 2mb.',
        showConfirmButton: true,
        confirmButtonText: 'Close',
        closeOnConfirm: true
      });
    } else {
      const imgData = new FileReader();
      imgData.readAsDataURL(img);

      $(imgData).on('load', event => {
        const imgRoute = event && event.target ? event.target.result : '';
        $('.pic-preview').attr('src', imgRoute);
      });
    }
  }
});
