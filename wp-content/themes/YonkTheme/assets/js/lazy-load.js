document.addEventListener("DOMContentLoaded", () => {
    var lazyImages = [].slice.call(document.querySelectorAll("img[data-src]"))

    if ("IntersectionObserver" in window) {
        const lazyImageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const lazyImage = entry.target
                    lazyImage.src = lazyImage.dataset.src
                    if (lazyImage.dataset.srcset) {
                        lazyImage.srcset = lazyImage.dataset.srcset
                    }
                    lazyImage.classList.remove("lazy")
                    lazyImageObserver.unobserve(lazyImage)
                }
            })
        })

        lazyImages.forEach((lazyImage) => {
            lazyImageObserver.observe(lazyImage)
        })
    } else {
        // Fallback for browsers that don't support IntersectionObserver
        let active = false

        const lazyLoad = () => {
            if (active === false) {
                active = true

                setTimeout(() => {
                    lazyImages.forEach((lazyImage) => {
                        if (
                            lazyImage.getBoundingClientRect().top <= window.innerHeight &&
                            lazyImage.getBoundingClientRect().bottom >= 0 &&
                            getComputedStyle(lazyImage).display !== "none"
                        ) {
                            lazyImage.src = lazyImage.dataset.src
                            if (lazyImage.dataset.srcset) {
                                lazyImage.srcset = lazyImage.dataset.srcset
                            }
                            lazyImage.classList.remove("lazy")

                            lazyImages = lazyImages.filter((image) => image !== lazyImage)

                            if (lazyImages.length === 0) {
                                document.removeEventListener("scroll", lazyLoad)
                                window.removeEventListener("resize", lazyLoad)
                                window.removeEventListener("orientationchange", lazyLoad)
                            }
                        }
                    })

                    active = false
                }, 200)
            }
        }

        document.addEventListener("scroll", lazyLoad)
        window.addEventListener("resize", lazyLoad)
        window.addEventListener("orientationchange", lazyLoad)
    }
})

