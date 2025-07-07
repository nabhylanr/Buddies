<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calendar Dashboard</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 h-screen">

  <div class="flex h-full">
    <div class="w-64 bg-white border-r border-gray-200">
      @include('sidebar')
    </div>

    <div class="flex-1 overflow-y-auto">
      <div class="lg:flex lg:h-full lg:flex-col">
        <header class="flex items-center justify-between border-b border-gray-200 px-6 py-4 lg:flex-none">
          <h1 class="text-base font-semibold leading-6 text-gray-900" id="currentMonthYear">
            <time id="headerDate">Loading...</time>
          </h1>
          <div class="flex items-center">
            <div class="relative flex items-center rounded-md bg-white shadow-sm md:items-stretch">
              <!-- Prev Month Button -->
              <button type="button" id="prevMonth" class="flex h-9 w-12 items-center justify-center rounded-l-md border-y border-l border-gray-300 pr-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pr-0 md:hover:bg-gray-50">
                <span class="sr-only">Previous month</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                </svg>
              </button>
              <!-- Today Button -->
              <button type="button" id="todayBtn" class="hidden border-y border-gray-300 px-3.5 text-sm font-semibold text-gray-900 hover:bg-gray-50 focus:relative md:block">Today</button>
              <span class="relative -mx-px h-5 w-px bg-gray-300 md:hidden"></span>
              <!-- Next Month Button -->
              <button type="button" id="nextMonth" class="flex h-9 w-12 items-center justify-center rounded-r-md border-y border-r border-gray-300 pl-1 text-gray-400 hover:text-gray-500 focus:relative md:w-9 md:pl-0 md:hover:bg-gray-50">
                <span class="sr-only">Next month</span>
                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                </svg>
              </button>
            </div>

            <div class="hidden md:ml-4 md:flex md:items-center">
              <div class="relative">
                <button type="button" class="flex items-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true">
                  Month view
                  <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                  </svg>
                </button>
              </div>
              <div class="ml-6 h-6 w-px bg-gray-300"></div>
              <a href="{{ route('tasks.create') }}" class="ml-6 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">Add event</a>
            </div>
          </div>
        </header>

        <div class="shadow ring-1 ring-black ring-opacity-5 lg:flex lg:flex-auto lg:flex-col">
          <div class="grid grid-cols-7 gap-px border-b border-gray-300 bg-gray-200 text-center text-xs font-semibold leading-6 text-gray-700">
            <div class="bg-white py-2">Sun</div>
            <div class="bg-white py-2">Mon</div>
            <div class="bg-white py-2">Tue</div>
            <div class="bg-white py-2">Wed</div>
            <div class="bg-white py-2">Thu</div>
            <div class="bg-white py-2">Fri</div>
            <div class="bg-white py-2">Sat</div>
          </div>

          <div class="flex bg-gray-200 text-xs leading-6 text-gray-700 lg:flex-auto">
            <div class="w-full lg:grid lg:grid-cols-7 lg:grid-rows-6 lg:gap-px" id="calendar-grid">
              <!-- Loading indicator -->
              <div id="loading" class="col-span-7 flex items-center justify-center h-64">
                <div class="text-gray-500">Loading calendar...</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Task Detail Modal -->
  <div id="taskModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Task Details</h3>
              <div class="mt-2" id="modal-content">
                <!-- Task details will be inserted here -->
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" id="closeModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

<script>
class RealTimeCalendar {
  constructor() {
    this.viewDate = new Date();
    this.events = {};
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    this.init();
  }

  init() {
    this.setupEventListeners();
    this.render();
    this.loadEvents();
  }

  async loadEvents() {
    try {
      const start = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth(), 1);
      const end = new Date(this.viewDate.getFullYear(), this.viewDate.getMonth() + 1, 0);
      
      // FIX: Format tanggal dengan benar tanpa timezone shift
      const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
      };
      
      const response = await fetch(`/calendar/events?start=${formatDate(start)}&end=${formatDate(end)}`, {
        headers: {
          'X-CSRF-TOKEN': this.csrfToken,
          'Content-Type': 'application/json',
        }
      });
      
      if (response.ok) {
        this.events = await response.json();
        this.render();
      }
    } catch (error) {
      console.error('Error loading events:', error);
    }
  }

  setupEventListeners() {
    document.getElementById('prevMonth').addEventListener('click', () => {
      this.viewDate.setMonth(this.viewDate.getMonth() - 1);
      this.loadEvents();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
      this.viewDate.setMonth(this.viewDate.getMonth() + 1);
      this.loadEvents();
    });

    document.getElementById('todayBtn').addEventListener('click', () => {
      this.viewDate = new Date();
      this.loadEvents();
    });

    // Modal event listeners
    document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('taskModal').classList.add('hidden');
    });

    document.getElementById('taskModal').addEventListener('click', (e) => {
      if (e.target.id === 'taskModal') {
        document.getElementById('taskModal').classList.add('hidden');
      }
    });
  }

  showTaskDetails(task) {
    const modal = document.getElementById('taskModal');
    const modalContent = document.getElementById('modal-content');
    
    modalContent.innerHTML = `
      <div class="space-y-4">
        <div>
          <h4 class="font-medium text-gray-900">${task.title}</h4>
          <p class="text-sm text-gray-600 mt-1">${task.description || 'No description'}</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <span class="text-sm font-medium text-gray-700">Time:</span>
            <p class="text-sm text-gray-900">${task.time}</p>
          </div>
          <div>
            <span class="text-sm font-medium text-gray-700">Status:</span>
            <p class="text-sm text-gray-900 capitalize">${task.status || 'pending'}</p>
          </div>
        </div>
        <div>
          <span class="text-sm font-medium text-gray-700">Place:</span>
          <p class="text-sm text-gray-900">${task.place}</p>
        </div>
        <div>
          <span class="text-sm font-medium text-gray-700">Implementor:</span>
          <p class="text-sm text-gray-900">${task.implementor}</p>
        </div>
      </div>
    `;
    
    modal.classList.remove('hidden');
  }

  formatMonthYear(date) {
    return date.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
  }

  // FIX: Format date key tanpa timezone conversion
  formatDateKey(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }

  isToday(date) {
    const today = new Date();
    return date.toDateString() === today.toDateString();
  }

  isCurrentMonth(date) {
    return date.getMonth() === this.viewDate.getMonth() &&
           date.getFullYear() === this.viewDate.getFullYear();
  }

  generateCalendarDays() {
    const year = this.viewDate.getFullYear();
    const month = this.viewDate.getMonth();

    const firstDay = new Date(year, month, 1);
    const startDay = new Date(firstDay);
    startDay.setDate(firstDay.getDate() - firstDay.getDay());

    const days = [];
    for (let i = 0; i < 42; i++) {
      days.push(new Date(startDay));
      startDay.setDate(startDay.getDate() + 1);
    }

    return days;
  }

  getStatusColor(status) {
    switch (status) {
      case 'completed':
        return 'text-green-600';
      case 'cancelled':
        return 'text-red-600';
      case 'pending':
      default:
        return 'text-gray-900';
    }
  }

  renderDay(date) {
    const isCurrentMonth = this.isCurrentMonth(date);
    const isToday = this.isToday(date);
    const dateKey = this.formatDateKey(date);
    const dayEvents = this.events[dateKey] || [];

    const bgClass = isCurrentMonth ? 'bg-white' : 'bg-gray-50 text-gray-400';
    const dateClass = isToday
      ? 'flex h-6 w-6 items-center justify-center rounded-full bg-indigo-600 font-semibold text-white'
      : '';

    let eventsHtml = '';
    if (dayEvents.length > 0) {
      eventsHtml = `
        <ol class="mt-2 space-y-1">
          ${dayEvents.map(event => `
            <li>
              <button type="button" class="group flex w-full text-left task-event" data-task='${JSON.stringify(event)}'>
                <p class="flex-auto truncate font-medium ${this.getStatusColor(event.status || 'pending')} group-hover:text-indigo-600">${event.title}</p>
                <time datetime="${event.datetime}" class="ml-3 hidden flex-none text-gray-500 group-hover:text-indigo-600 xl:block">${event.time}</time>
              </button>
            </li>
          `).join('')}
        </ol>
      `;
    }

    return `
      <div class="relative ${bgClass} px-3 py-2 h-24 flex flex-col">
        <time datetime="${dateKey}" class="${dateClass}">${date.getDate()}</time>
        <div class="flex-1 overflow-hidden">
          ${eventsHtml}
        </div>
      </div>
    `;
  }

  render() {
    document.getElementById('headerDate').textContent = this.formatMonthYear(this.viewDate);
    document.getElementById('headerDate').setAttribute('datetime', this.viewDate.toISOString().slice(0, 7));

    const days = this.generateCalendarDays();
    const calendarGrid = document.getElementById('calendar-grid');
    calendarGrid.innerHTML = days.map(day => this.renderDay(day)).join('');

    // Add event listeners to task events
    document.querySelectorAll('.task-event').forEach(button => {
      button.addEventListener('click', (e) => {
        const task = JSON.parse(e.currentTarget.dataset.task);
        this.showTaskDetails(task);
      });
    });

    // Hide loading indicator
    const loading = document.getElementById('loading');
    if (loading) {
      loading.remove();
    }
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new RealTimeCalendar();
});
</script>

</body>
</html>