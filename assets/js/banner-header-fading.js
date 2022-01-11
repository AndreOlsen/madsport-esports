var headings = jQuery('h2[class*="fading-"]').hide(),
    i = 0;

(function cycle() { 

    headings.eq(i).fadeIn(1000)
              .delay(2000)
              .fadeOut(1000, cycle);

    i = ++i % headings.length;

})();