// JavaScript to handle opening and closing the form
function openForm() {
    document.getElementById("formPrice").style.display = "flex";
  }
  
  function closeForm() {
    document.getElementById("formPrice").style.display = "none";
  }
  function openForm1() {
    document.getElementById("formUpdate").style.display = "flex";
  }
  
  function closeForm1() {
    document.getElementById("formUpdate").style.display = "none";
  }
  
  // Optional: Handle form submission
  document
    .getElementById("chaoGiaForm")
    .addEventListener("submit", function (event) {
      // Collect form data and handle submission here
      closeForm();
    });
  ////////////////////////////////Phân Trang///////////////////////////////////////////////
  let currentPage = 1;
  let pageNumber = parseInt(
    document.getElementById("soTrang").textContent.trim()
  );
  function loadPage(page) {
    $.ajax({
      method: "post",
      url: "../mvc/core/ajax.php",
      data: {
        page: page,
      },
    })
      .done(function (data) {
        $("#danh_sach_cong_viec").html(data);
        currentPage = page;
        updatePagination(); // Cập nhật giao diện phân trang
      })
      .fail(function (data) {
        console.log("Đã xảy ra lỗi.");
      });
  }
  
  function updatePagination() {
    $(".sotrang").removeClass("active-page");
    $('.sotrang[data-page="' + currentPage + '"]').addClass("active-page");
  
    // Cập nhật hiển thị số trang với cố định 3 số
    let totalPages = pageNumber;
    let startPage = Math.max(1, currentPage - 1);
    let endPage = Math.min(totalPages, currentPage + 1);
  
    // Điều chỉnh khi ở gần trang đầu tiên hoặc trang cuối cùng
    if (currentPage === 1) {
      endPage = Math.min(3, totalPages);
    } else if (currentPage === totalPages) {
      startPage = Math.max(1, totalPages - 2);
    }
  
    let paginationHtml = "";
    for (let i = startPage; i <= endPage; i++) {
      let activeClass = i === currentPage ? "active-page" : "";
      paginationHtml +=
        "<li><span class='sotrang " +
        activeClass +
        "' data-page='" +
        i +
        "'>" +
        i +
        "</span></li>";
    }
  
    $("ul").html(paginationHtml);
  }
  
  $(document).on("click", ".sotrang", function (e) {
    e.preventDefault();
    let page = parseInt($(this).attr("data-page"));
    loadPage(page);
  });
  
  $(document).on("click", ".bagi-btn-prev", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      loadPage(currentPage - 1);
    }
  });
  
  $(document).on("click", ".bagi-btn-next", function (e) {
    e.preventDefault();
    let totalPages = pageNumber;
    if (currentPage < totalPages) {
      loadPage(currentPage + 1);
    }
  });