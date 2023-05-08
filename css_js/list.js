var swiper = new Swiper(".mySwiper", { // swiper omogoča horizontalno skrollanje po divu
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
      hide:true,
    
    },
    breakpoints: { // omeji koliko boxu igrc je lahko naenkrat vidnih glede na resolucijo okna
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 7,
        spaceBetween: 0,
      },
    },
  });