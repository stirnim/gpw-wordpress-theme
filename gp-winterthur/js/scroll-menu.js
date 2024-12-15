/* SCROLL SCRIPT */
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header'); // Adjust the selector to match your header element
    const headerWid = document.querySelector('h1.header-wide'); // Adjust the selector to match your h1 element
    const stickyClass = 'scrolled';

    // Check if we are on the homepage (using the 'home' class added by WordPress)
    if (document.body.classList.contains('home') || document.body.classList.contains('front-page')) {
        window.addEventListener('scroll', function() {
            const headerRect = header.getBoundingClientRect();
            const headerWidRect = headerWid.getBoundingClientRect();

            if (headerRect.bottom >= headerWidRect.top) {
                header.classList.add(stickyClass);
            } else {
                header.classList.remove(stickyClass);
            }
        });
    } else {
        // Keep the previous behavior for other pages
        window.addEventListener('scroll', function() {
            if (window.scrollY > 0) {
                header.classList.add(stickyClass);
            } else {
                header.classList.remove(stickyClass);
            }
        });
    }
});

/* SUBMENU SCRIPT */
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const navigation = document.querySelector('.inside-navigation');
    const submenuClass = 'submenu-open';

    if (navigation && header) {
        // Desktop hover behavior (still applies if device can actually use hover)
        navigation.addEventListener('mouseenter', function() {
            if (window.innerWidth > 810) {
                header.classList.add(submenuClass);
            }
        });

        navigation.addEventListener('mouseleave', function() {
            if (window.innerWidth > 810) {
                header.classList.remove(submenuClass);
            }
        });

        // Click event for wider screens
        navigation.addEventListener('click', function(e) {
            if (window.innerWidth > 810) {
                header.classList.add(submenuClass);
                e.stopPropagation();
            }
        });

        // Touch event for wider screens (treat touch like a click)
        navigation.addEventListener('touchstart', function(e) {
            if (window.innerWidth > 810) {
                header.classList.add(submenuClass);
                e.stopPropagation();
            }
        });

        // Close submenu if clicked outside
        document.addEventListener('click', function(e) {
            if (header.classList.contains(submenuClass) && !navigation.contains(e.target)) {
                header.classList.remove(submenuClass);
            }
        });
    }
});


/* MOBILE MENU TOGGLE */
document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const htmlElement = document.documentElement; // the <html> element
  const mobileMenuWrapper = document.querySelector('.mobile-menu-control-wrapper');
  const subMenuRight = document.querySelector('.sub-menu-right');
  
  // Define what "mobile view" means. Adjust if needed.
  function isMobileView() {
    return window.innerWidth < 810;
  }
	
  // Toggle the mobile menu and related elements
  menuToggle.addEventListener('click', () => {
    htmlElement.classList.toggle('mobile-menu-open');
    
    if (mobileMenuWrapper) {
      mobileMenuWrapper.classList.toggle('toggled');
    }

    if (subMenuRight) {
      subMenuRight.classList.toggle('toggled');
    }
  });

  // Toggle the 'toggled-on' class for child .sub-menu elements
  const menuItems = document.querySelectorAll('.menu-item');

  menuItems.forEach(menuItem => {
    menuItem.addEventListener('click', (event) => {
      // Prevents click from propagating to parent menu item (if nested)
      event.stopPropagation();

      const subMenu = menuItem.querySelector('.sub-menu');
      if (subMenu) {
        subMenu.classList.toggle('toggled-on');
      }
    });
  });
	
  // Reset menu state on resize when exiting mobile view
  window.addEventListener('resize', () => {
    // Only do this if we've moved out of mobile view
    if (!isMobileView()) {
      // If the mobile menu is active, trigger a click to close it
      if (htmlElement.classList.contains('mobile-menu-open')) {
        menuToggle.click();
      }
    }
  });
});