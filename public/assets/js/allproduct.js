
        // Toggle wishlist icon color
        function toggleWishlist(icon) {
            icon.classList.toggle('selected');
        }
 
        // Get elements
        const sortBtn = document.getElementById('sortBtn');
        const sortModal = document.getElementById('sortModal');
        const overlay = document.getElementById('overlay');
        
        // Open modal when clicking the sort button
        sortBtn.addEventListener('click', function() {
            sortModal.classList.add('show');
            overlay.style.display = 'block';
        });
        
        // Close modal when clicking outside
        overlay.addEventListener('click', function() {
            sortModal.classList.remove('show');
            overlay.style.display = 'none';
        });
        
        // Handle sort option selection
        const sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Find the radio button within this option and check it
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                
                // Close modal after a brief delay
                setTimeout(() => {
                    sortModal.classList.remove('show');
                    overlay.style.display = 'none';
                }, 300);
                
                // Get the selected option text
                const selectedSort = this.querySelector('span').textContent;
                console.log('Selected sort option:', selectedSort);
            });
        });
 
       function openFilterModal() {
        document.getElementById('filterModal').style.display = 'flex';
        // Show Size options by default when modal opens
        openSizeOptions();
    }
    
    function closeFilterModal() {
        document.getElementById('filterModal').style.display = 'none';
    }
    
    function openSizeOptions() {
        hideAllOptionPanels();
        document.getElementById('sizeOptionsPanel').style.display = 'block';
        highlightCategory('Size');
    }
    
    function openPriceOptions() {
        hideAllOptionPanels();
        document.getElementById('priceOptionsPanel').style.display = 'block';
        highlightCategory('Price');
    }
    
    function openColorOptions() {
        hideAllOptionPanels();
        document.getElementById('colorOptionsPanel').style.display = 'block';
        highlightCategory('Color');
    }
    
    function hideAllOptionPanels() {
        const panels = document.querySelectorAll('.options-panel');
        panels.forEach(panel => {
            panel.style.display = 'none';
        });
    }
    
    function highlightCategory(categoryName) {
        // Remove active class from all categories
        const categories = document.querySelectorAll('.filter-category');
        categories.forEach(cat => {
            cat.classList.remove('active');
        });
        
        // Add active class to selected category
        const category = Array.from(categories).find(cat => 
            cat.textContent.trim().startsWith(categoryName)
        );
        if (category) {
            category.classList.add('active');
        }
    }
    
    function clearAllFilters() {
        // Implementation for clearing all filters
        console.log('All filters cleared');
    }
    
    function applyFilters() {
        // Implementation for applying filters
        console.log('Filters applied');
        closeFilterModal();
    }
    
  
        
    document.addEventListener('DOMContentLoaded', function() {
        const minSlider = document.getElementById('min-price-slider');
        const maxSlider = document.getElementById('max-price-slider');
        const minDisplay = document.getElementById('min-price-display');
        const maxDisplay = document.getElementById('max-price-display');
        const minInput = document.getElementById('min-price-input');
        const maxInput = document.getElementById('max-price-input');
        
        minSlider.addEventListener('input', function() {
            const minVal = parseInt(minSlider.value);
            const maxVal = parseInt(maxSlider.value);
            
            if (minVal > maxVal) {
                minSlider.value = maxVal;
                return;
            }
            
            minDisplay.textContent = '₹' + minVal.toLocaleString();
            minInput.value = minVal;
        });
        
        maxSlider.addEventListener('input', function() {
            const minVal = parseInt(minSlider.value);
            const maxVal = parseInt(maxSlider.value);
            
            if (maxVal < minVal) {
                maxSlider.value = minVal;
                return;
            }
            
            maxDisplay.textContent = '₹' + maxVal.toLocaleString();
            maxInput.value = maxVal;
        });
    });
   
        document.addEventListener('DOMContentLoaded', function() {
    // Get all radio buttons for sorting
    const sortRadios = document.querySelectorAll('input[name="sort"]');
    
    // Get the container and product cards
    // You may need to adjust these selectors to match your HTML structure
    const productsContainer = document.querySelector('.row');
    const productCards = document.querySelectorAll('.col-6');
    
    // Add click event listener to each radio button
    sortRadios.forEach(radio => {
        radio.addEventListener('click', function() {
            const sortValue = this.value;
            console.log("Sort option selected:", sortValue);
            
            // Apply sorting based on the selected value
            sortProducts(sortValue);
        });
    });
    
    // Sorting function
    function sortProducts(sortType) {
        // Convert NodeList to Array for sorting
        const productArray = Array.from(productCards);
        
        switch(sortType) {
            case 'latest':
                productArray.sort((a, b) => {
                    const dateA = new Date(a.dataset.createdAt || 0);
                    const dateB = new Date(b.dataset.createdAt || 0);
                    return dateB - dateA; // Newest first
                });
                break;
                
            case 'price_high_low':
                productArray.sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price || 0);
                    const priceB = parseFloat(b.dataset.price || 0);
                    return priceB - priceA; // High to low
                });
                break;
                
            case 'price_low_high':
                productArray.sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price || 0);
                    const priceB = parseFloat(b.dataset.price || 0);
                    return priceA - priceB; // Low to high
                });
                break;
        }
        
        // Reorder in the DOM
        productArray.forEach(card => {
            productsContainer.appendChild(card);
        });
    }
});
      
        document.addEventListener('DOMContentLoaded', function() {
            // Get all color filter divs
            const colorOptions = document.querySelectorAll('.color-option');
            
            // Get the container where products are displayed
            const productsContainer = document.querySelector('.row'); // Adjust this selector to match your actual container
            const productCards = document.querySelectorAll('.col-6');
            
            // Track active color filters (using an array for multiple selections)
            let activeColorFilters = [];
            
            // Add event listeners to the color option divs
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const color = this.dataset.color;
                    const checkboxInput = this.querySelector('input[type="checkbox"]');
                    
                    // Toggle the checkbox state
                    checkboxInput.checked = !checkboxInput.checked;
                    
                    // Toggle the active class
                    this.classList.toggle('active');
                    
                    // Update active filters array
                    if (checkboxInput.checked) {
                        // Add color to active filters if not already present
                        if (!activeColorFilters.includes(color)) {
                            activeColorFilters.push(color);
                        }
                    } else {
                        // Remove color from active filters
                        activeColorFilters = activeColorFilters.filter(c => c !== color);
                    }
                    
                    // Apply filters
                    if (activeColorFilters.length > 0) {
                        filterByMultipleColors(activeColorFilters);
                    } else {
                        // Show all products if no filters are active
                        productCards.forEach(card => {
                            card.style.display = 'block';
                        });
                    }
                });
            });
            
            // Function to filter products by multiple colors
            function filterByMultipleColors(colors) {
                productCards.forEach(card => {
                    const productColor = card.dataset.color;
                    
                    if (colors.includes(productColor)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            
            // Add CSS for active state
            const style = document.createElement('style');
            style.textContent = `
                .color-option.active {
                    background-color: #f0f0f0;
                    font-weight: bold;
                }
            `;
            document.head.appendChild(style);
        });
  
document.addEventListener('DOMContentLoaded', function() {
    // Get all category filter options
    const categoryOptions = document.querySelectorAll('.category-option');
    
    // Get the product cards
    const productCards = document.querySelectorAll('.col-6');
    
    // Track active category filters
    let activeCategoryFilters = [];
    
    // Add event listeners to category options
    categoryOptions.forEach(option => {
        option.addEventListener('click', function() {
            const category = this.dataset.category;
            const checkboxInput = this.querySelector('input[type="checkbox"]');
            
            // Toggle the checkbox state
            checkboxInput.checked = !checkboxInput.checked;
            
            // Toggle the active class
            this.classList.toggle('active');
            
            // Update active filters array
            if (checkboxInput.checked) {
                // Add category to active filters if not already present
                if (!activeCategoryFilters.includes(category)) {
                    activeCategoryFilters.push(category);
                }
            } else {
                // Remove category from active filters
                activeCategoryFilters = activeCategoryFilters.filter(c => c !== category);
            }
            
            // Apply category filters
            if (activeCategoryFilters.length > 0) {
                filterByMultipleCategories(activeCategoryFilters);
            } else {
                // Show all products if no filters are active
                productCards.forEach(card => {
                    card.style.display = 'block';
                });
            }
        });
    });
    
    // Function to filter products by multiple categories
    function filterByMultipleCategories(categories) {
        productCards.forEach(card => {
            const productCategory = card.dataset.category;
            
            if (categories.includes(productCategory)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    // Add CSS for active state
    const style = document.createElement('style');
    style.textContent = `
        .category-option.active {
            background-color: #f0f0f0;
            font-weight: bold;
        }
    `;
    document.head.appendChild(style);
});

        document.addEventListener('DOMContentLoaded', function() {
        // Price slider elements
        const range = document.getElementById('price-range');
        const minThumb = document.getElementById('min-thumb');
        const maxThumb = document.getElementById('max-thumb');
        const track = document.querySelector('.track');
        const minPriceInput = document.getElementById('min-price-input');
        const maxPriceInput = document.getElementById('max-price-input');
        const minPriceDisplay = document.getElementById('min-price-display');
        const maxPriceDisplay = document.getElementById('max-price-display');
        
        // Initial values
        const minPrice = parseFloat(minPriceInput.value);
        const maxPrice = parseFloat(maxPriceInput.value);
        const priceGap = (maxPrice - minPrice) * 0.05; // 5% of total range as minimum gap
        
        // For tracking active thumb
        let activeThumb = null;
        
        // Set initial positions
        let leftPercent = 0;
        let rightPercent = 100;
        
        // Set initial range position
        updateRangeStyle();
        
        // Events for min thumb
        minThumb.addEventListener('mousedown', function(e) {
            e.preventDefault();
            activeThumb = 'min';
            minThumb.classList.add('active');
            document.addEventListener('mousemove', moveThumb);
            document.addEventListener('mouseup', stopMoving);
        });
        
        // Events for max thumb
        maxThumb.addEventListener('mousedown', function(e) {
            e.preventDefault();
            activeThumb = 'max';
            maxThumb.classList.add('active');
            document.addEventListener('mousemove', moveThumb);
            document.addEventListener('mouseup', stopMoving);
        });
        
        // Move thumb function
        function moveThumb(e) {
            if (!activeThumb) return;
            
            const trackRect = track.getBoundingClientRect();
            const trackWidth = trackRect.width;
            const trackLeft = trackRect.left;
            
            let position = (e.clientX - trackLeft) / trackWidth * 100;
            position = Math.max(0, Math.min(position, 100));
            
            if (activeThumb === 'min') {
                // Ensure min thumb doesn't go beyond max thumb - priceGap
                const rightPos = rightPercent;
                const minGapPercent = (priceGap / (maxPrice - minPrice)) * 100;
                
                if (position > rightPos - minGapPercent) {
                    position = rightPos - minGapPercent;
                }
                
                leftPercent = position;
                const newMinPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                minPriceInput.value = newMinPrice;
                minPriceDisplay.textContent = '₹' + numberWithCommas(newMinPrice);
            } else {
                // Ensure max thumb doesn't go below min thumb + priceGap
                const leftPos = leftPercent;
                const minGapPercent = (priceGap / (maxPrice - minPrice)) * 100;
                
                if (position < leftPos + minGapPercent) {
                    position = leftPos + minGapPercent;
                }
                
                rightPercent = position;
                const newMaxPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                maxPriceInput.value = newMaxPrice;
                maxPriceDisplay.textContent = '₹' + numberWithCommas(newMaxPrice);
            }
            
            updateRangeStyle();
            filterProductsByPrice();
        }
        
        // Stop moving function
        function stopMoving() {
            if (activeThumb) {
                document.querySelector('.thumb.active').classList.remove('active');
                activeThumb = null;
                document.removeEventListener('mousemove', moveThumb);
                document.removeEventListener('mouseup', stopMoving);
            }
        }
        
        // Update the range style
        function updateRangeStyle() {
            range.style.left = leftPercent + '%';
            range.style.width = (rightPercent - leftPercent) + '%';
            minThumb.style.left = leftPercent + '%';
            maxThumb.style.left = rightPercent + '%';
        }
        
        // Filter products by price range
        function filterProductsByPrice() {
            const currentMinPrice = parseInt(minPriceInput.value);
            const currentMaxPrice = parseInt(maxPriceInput.value);
            
            // Get all product cards
            const productCards = document.querySelectorAll('.col-6');
            
            productCards.forEach(card => {
                const productPrice = parseInt(card.dataset.price);
                
                if (productPrice >= currentMinPrice && productPrice <= currentMaxPrice) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Helper function to format numbers with commas
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        
        // Touch events for mobile support
        minThumb.addEventListener('touchstart', function(e) {
            e.preventDefault();
            activeThumb = 'min';
            minThumb.classList.add('active');
            document.addEventListener('touchmove', touchMoveThumb);
            document.addEventListener('touchend', stopTouchMoving);
        });
        
        maxThumb.addEventListener('touchstart', function(e) {
            e.preventDefault();
            activeThumb = 'max';
            maxThumb.classList.add('active');
            document.addEventListener('touchmove', touchMoveThumb);
            document.addEventListener('touchend', stopTouchMoving);
        });
        
        function touchMoveThumb(e) {
            if (!activeThumb) return;
            
            const touch = e.touches[0];
            const trackRect = track.getBoundingClientRect();
            const trackWidth = trackRect.width;
            const trackLeft = trackRect.left;
            
            let position = (touch.clientX - trackLeft) / trackWidth * 100;
            position = Math.max(0, Math.min(position, 100));
            
            if (activeThumb === 'min') {
                const rightPos = rightPercent;
                const minGapPercent = (priceGap / (maxPrice - minPrice)) * 100;
                
                if (position > rightPos - minGapPercent) {
                    position = rightPos - minGapPercent;
                }
                
                leftPercent = position;
                const newMinPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                minPriceInput.value = newMinPrice;
                minPriceDisplay.textContent = '₹' + numberWithCommas(newMinPrice);
            } else {
                const leftPos = leftPercent;
                const minGapPercent = (priceGap / (maxPrice - minPrice)) * 100;
                
                if (position < leftPos + minGapPercent) {
                    position = leftPos + minGapPercent;
                }
                
                rightPercent = position;
                const newMaxPrice = Math.round(minPrice + (position / 100) * (maxPrice - minPrice));
                maxPriceInput.value = newMaxPrice;
                maxPriceDisplay.textContent = '₹' + numberWithCommas(newMaxPrice);
            }
            
            updateRangeStyle();
            filterProductsByPrice();
        }
        
        function stopTouchMoving() {
            if (activeThumb) {
                document.querySelector('.thumb.active').classList.remove('active');
                activeThumb = null;
                document.removeEventListener('touchmove', touchMoveThumb);
                document.removeEventListener('touchend', stopTouchMoving);
            }
        }
    });
  
 