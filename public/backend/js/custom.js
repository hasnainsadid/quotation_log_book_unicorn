function deleteData(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
}

// $(".single-select").select2({
//     theme: "bootstrap-5",
//     width: $(this).data("width")
//         ? $(this).data("width")
//         : $(this).hasClass("w-100")
//         ? "100%"
//         : "style",
//     placeholder: $(this).data("placeholder"),
// });