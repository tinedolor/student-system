document.addEventListener('DOMContentLoaded', function() {
    // Calendar functionality
    const monthView = document.getElementById('month-view');
    const listView = document.getElementById('list-view');
    const monthGrid = document.getElementById('month-grid');
    const eventList = document.getElementById('event-list');
    const currentMonthElement = document.getElementById('current-month');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');
    const viewToggleButtons = document.querySelectorAll('[data-view]');
    const termSelector = document.getElementById('term-selector');
    const printBtn = document.getElementById('print-calendar');
    
    let currentDate = new Date();
    
    // Initialize calendar
    function initCalendar() {
        renderMonthCalendar(currentDate);
        renderEventList();
        setupEventFilters();
    }
    
    // Render month calendar
    function renderMonthCalendar(date) {
        const year = date.getFullYear();
        const month = date.getMonth();
        
        // Set current month header
        currentMonthElement.textContent = new Intl.DateTimeFormat('en-US', { 
            month: 'long', 
            year: 'numeric' 
        }).format(date);
        
        // Clear previous month
        monthGrid.innerHTML = '';
        
        // Get first day of month and day of week
        const firstDay = new Date(year, month, 1);
        const firstDayOfWeek = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)
        
        // Get last day of month
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        
        // Get days from previous month to show
        const prevMonthLastDay = new Date(year, month, 0).getDate();
        
        // Create calendar grid
        let dayCount = 1;
        let nextMonthDayCount = 1;
        
        for (let i = 0; i < 42; i++) { // 6 weeks * 7 days
            const dayElement = document.createElement('div');
            
            if (i < firstDayOfWeek) {
                // Days from previous month
                const prevDay = prevMonthLastDay - firstDayOfWeek + i + 1;
                dayElement.classList.add('calendar-day', 'empty');
                dayElement.innerHTML = `<div class="calendar-day-header">${prevDay}</div>`;
            } else if (dayCount <= daysInMonth) {
                // Current month days
                const currentDay = new Date(year, month, dayCount);
                const isToday = isSameDay(currentDay, new Date());
                
                dayElement.classList.add('calendar-day');
                if (isToday) dayElement.classList.add('today');
                
                dayElement.innerHTML = `
                    <div class="calendar-day-header">${dayCount}</div>
                    <div class="calendar-events" data-date="${formatDate(currentDay)}"></div>
                `;
                
                dayCount++;
            } else {
                // Days from next month
                dayElement.classList.add('calendar-day', 'empty');
                dayElement.innerHTML = `<div class="calendar-day-header">${nextMonthDayCount}</div>`;
                nextMonthDayCount++;
            }
            
            monthGrid.appendChild(dayElement);
        }
        
        // Add events to calendar
        renderEventsOnCalendar();
    }
    
    // Render events on the month calendar
    function renderEventsOnCalendar() {
        academicEvents.forEach(event => {
            const eventDate = new Date(event.date);
            const eventElement = document.querySelector(`.calendar-events[data-date="${formatDate(eventDate)}"]`);
            
            if (eventElement) {
                const eventDiv = document.createElement('div');
                eventDiv.classList.add('calendar-event', event.category);
                eventDiv.textContent = event.title;
                eventDiv.title = event.description;
                
                eventDiv.addEventListener('click', () => {
                    alert(`${event.title}\n\nDate: ${formatReadableDate(eventDate)}\nDescription: ${event.description}`);
                });
                
                eventElement.appendChild(eventDiv);
            }
            
            // Handle multi-day events
            if (event.endDate) {
                const endDate = new Date(event.endDate);
                let currentDate = new Date(event.date);
                currentDate.setDate(currentDate.getDate() + 1);
                
                while (currentDate <= endDate) {
                    const currentEventElement = document.querySelector(`.calendar-events[data-date="${formatDate(currentDate)}"]`);
                    
                    if (currentEventElement) {
                        const eventDiv = document.createElement('div');
                        eventDiv.classList.add('calendar-event', event.category);
                        eventDiv.textContent = event.title;
                        eventDiv.title = event.description;
                        currentEventElement.appendChild(eventDiv);
                    }
                    
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            }
        });
    }
    
    // Render event list view
    function renderEventList() {
        eventList.innerHTML = '';
        
        // Sort events by date
        const sortedEvents = [...academicEvents].sort((a, b) => {
            return new Date(a.date) - new Date(b.date);
        });
        
        sortedEvents.forEach(event => {
            const eventDate = new Date(event.date);
            const eventItem = document.createElement('div');
            eventItem.classList.add('event-item');
            eventItem.dataset.category = event.category;
            
            eventItem.innerHTML = `
                <div class="event-date">
                    <div class="event-day">${eventDate.getDate()}</div>
                    <div class="event-month">${eventDate.toLocaleString('default', { month: 'short' })}</div>
                </div>
                <div class="event-details">
                    <h4 class="event-title">${event.title}</h4>
                    <p class="event-description">${event.description}</p>
                    <span class="event-category ${event.category}">${event.category.charAt(0).toUpperCase() + event.category.slice(1)}</span>
                </div>
            `;
            
            eventList.appendChild(eventItem);
        });
    }
    
    // Setup event filters
    function setupEventFilters() {
        const checkboxes = document.querySelectorAll('.event-filters input[type="checkbox"]');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const category = this.dataset.category;
                const eventItems = document.querySelectorAll('.event-item');
                
                eventItems.forEach(item => {
                    if (item.dataset.category === category) {
                        item.style.display = this.checked ? 'flex' : 'none';
                    }
                });
            });
        });
    }
    
    // View toggle functionality
    viewToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            viewToggleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            if (view === 'month') {
                monthView.classList.remove('hidden');
                listView.classList.add('hidden');
            } else {
                monthView.classList.add('hidden');
                listView.classList.remove('hidden');
            }
        });
    });
    
    // Navigation between months
    prevMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderMonthCalendar(currentDate);
    });
    
    nextMonthBtn.addEventListener('click', function() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderMonthCalendar(currentDate);
    });
    
    // Term selector
    termSelector.addEventListener('change', function() {
        // In a real app, this would load different calendar data
        alert(`Loading ${this.value} calendar...`);
    });
    
    // Print functionality
    printBtn.addEventListener('click', function() {
        window.print();
    });
    
    // Helper functions
    function isSameDay(date1, date2) {
        return date1.getFullYear() === date2.getFullYear() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getDate() === date2.getDate();
    }
    
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }
    
    function formatReadableDate(date) {
        return date.toLocaleDateString('en-US', { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        });
    }
    
    // Initialize the calendar
    initCalendar();
});