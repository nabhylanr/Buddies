<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Sidebar Component</title>
</head>
<body class="bg-gray-50">

<div class="h-full bg-white shadow-md px-4 py-6 space-y-6">
  <div class="text-2xl font-bold text-indigo-600 text-center">
    Kopra Scheduling
  </div>

  <nav class="space-y-2">
    <a href="/dashboard" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">
      <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 4h6m-6 4h6m-6 4h6" />
      </svg>
      Dashboard
    </a>

    <a href="/calendar" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">
      <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
      </svg>
      Calendar
    </a>

    <a href="/tasks" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">
      <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M5 13l4 4L19 7" />
      </svg>
      Tasks
    </a>

    <a href="/settings" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">
      <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M12 6V4m0 16v-2m4.24-10.24l1.42-1.42M6.34 17.66l1.42-1.42m0-10.24l-1.42-1.42M17.66 17.66l-1.42-1.42M21 12h-2M5 12H3" />
      </svg>
      Settings
    </a>
  </nav>
</div>
