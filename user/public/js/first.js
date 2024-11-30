const nganhs = [
    "Dịch Thuật",
    "Lập Trình",
    "Marketing",
    "Quay Phim",
    "Thiết Kế",
  ];
  const text = document.getElementById("text");
  let nganh = 0;
  let kiTu = 0;
  
  function themKiTu() {
    if (kiTu < nganhs[nganh].length) {
      text.textContent += nganhs[nganh].charAt(kiTu);//charAt : xác định kí tự thứ mấy
      kiTu++;
      setTimeout(themKiTu, 150);
    } else {
      setTimeout(xoaKiTu, 1000);
    }
  }
  
  function xoaKiTu() {
    if (kiTu > 0) {
      text.textContent = nganhs[nganh].substring(0, kiTu - 1);// substring: xoá kí tự cuối cùng của chuổi bắt đầu từ vị trí cuối cùng
      kiTu--;
      setTimeout(xoaKiTu, 100);
    } else {
      nganh = (nganh + 1) % nganhs.length;
      setTimeout(themKiTu, 500);
    }
  }
  
  document.addEventListener("DOMContentLoaded", function () {
    setTimeout(themKiTu, 500);// bắt đầu gõ sau 500ms
  });