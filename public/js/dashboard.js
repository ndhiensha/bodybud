
        /* === NOTIFICATION PANEL === */
        const notifBtn = document.getElementById("notifBtn");
        const notifPanel = document.getElementById("notifPanel");

        notifBtn.addEventListener("click", () => {
            notifPanel.style.display =
                notifPanel.style.display === "block" ? "none" : "block";
        });


        /* === LOGOUT MODAL === */
        const btnLogout = document.getElementById("btnLogout");
        const logoutModal = document.getElementById("logoutModal");
        const btnCancelLogout = document.getElementById("btnCancelLogout");

        btnLogout.addEventListener("click", () => {
            logoutModal.classList.add("active");
        });

        btnCancelLogout.addEventListener("click", () => {
            logoutModal.classList.remove("active");
        });

        logoutModal.addEventListener("click", (e) => {
            if (e.target === logoutModal) {
                logoutModal.classList.remove("active");
            }
        });

        // Sticky header with scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
