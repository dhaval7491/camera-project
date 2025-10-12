@extends('layouts.app')
@section('content')
<!-- Flatpickr Date Picker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    .video-box {
        height: 60px;
        width: 100%;
        max-width: 100%;
        position: relative;
        margin: 10px;
        overflow: hidden;
    }

    .video-box video {
        width: 100% !important;
        height: 100% !important;
        display: block;
        object-fit: cover;
    }

    .video-info {
        position: absolute;
        bottom: 5px;
        right: 5px;
        display: flex;
        align-items: center;
    }

    .video-status {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .status-connecting {
        background-color: orange;
    }

    .status-connected {
        background-color: green;
    }

    .status-disconnected {
        background-color: red;
    }

    /* Main video container styling */
    .main-video-container {
        width: 100%;
        height: 100%;
        position: relative;
        overflow: hidden;
        background-color: #000;
        border-radius: 0px;
    }

    .main-video-container video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        display: block !important;
    }

    /* Control buttons styling */
    .control-btn {
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.3s;
    }

    .control-btn:hover {
        opacity: 1;
    }

    .control-btn img {
        filter: brightness(0) invert(1);
    }

    /* Volume and size controls */
    .volume-control input[type="range"],
    .size-control input[type="range"] {
        width: 60px;
    }

    /* Active tab styling for projects */
    .tab-button {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .tab-button.active {
        background-color: #3b82f6 !important;
        border-color: #2563eb !important;
        color: white !important;
        box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
    }

    .tab-button.active p {
        color: white !important;
    }

    .tab-button:hover {
        background-color: #e5e7eb;
    }

    .tab-button.active:hover {
        background-color: #2563eb !important;
    }

    /* Main tabs styling */
    .main-tab-button {
        padding: 12px 24px;
        background-color: #374151;
        color: #9CA3AF;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 8px 8px 0 0;
    }

    .main-tab-button:hover {
        background-color: #4B5563;
        color: #D1D5DB;
    }

    .main-tab-button.active {
        background-color: #3B82F6 !important;
        color: white !important;
    }

    .main-tab-button svg {
        width: 20px;
        height: 20px;
    }

    .tab-content {
        display: none;
        /* background-color: #1F2937; */
        border-radius: 0 8px 8px 8px;
        min-height: 600px;
    }

    .tab-content.active {
        display: block;
    }

    /* Loading spinner */
    .loading-spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
        margin: 20px auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* All Cam View Grid Styles */
    .all-cam-grid {
        min-height: 400px;
    }

    .camera-grid-item {
        position: relative;
        background-color: #000;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 16/9;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .camera-grid-item:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .camera-grid-item video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .camera-offline {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #666;
        background-color: #1a1a1a;
    }

    .camera-live-indicator {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        padding: 4px 8px;
        border-radius: 4px;
    }

    .camera-name-label {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
    }

    .camera-status-indicator {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    /* Recordings tab specific styles */
    .recordings-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 500px;
        color: #9CA3AF;
    }

    .recordings-icon {
        width: 80px;
        height: 80px;
        background-color: #374151;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .recordings-icon svg {
        width: 40px;
        height: 40px;
        color: #6B7280;
    }

    .recordings-player-container {
        width: 100%;
        height: 600px;
        background-color: #0a0a0a;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    .recordings-video-wrapper {
        flex: 1;
        position: relative;
        background-color: #000;
        overflow: hidden;
    }

    .recordings-video-container {
        width: 100%;
        height: 100%;
        position: relative;
        background-color: #000;
    }

    .recordings-video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #000;
    }

    .recordings-info-overlay {
        position: absolute;
        top: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .recordings-controls-bar {
        background: #1a1a1a;
        border-top: 1px solid #2a2a2a;
        display: flex;
        flex-direction: column;
    }

    .controls-top-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border-bottom: 1px solid #2a2a2a;
        background: #1a1a1a;
    }

    .controls-left,
    .controls-center,
    .controls-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .control-btn-icon {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.2s;
    }

    .control-btn-icon:hover {
        background: #2a2a2a;
        color: #fff;
    }

    .control-btn-icon svg {
        width: 20px;
        height: 20px;
    }

    .play-btn {
        width: 40px;
        height: 40px;
        background: #3b82f6;
        color: white;
    }

    .play-btn:hover {
        background: #2563eb;
    }

    .filter-label {
        color: #9ca3af;
        font-size: 13px;
    }

    .divider {
        color: #4a4a4a;
        margin: 0 8px;
    }

    .speed-selector {
        background: #2a2a2a;
        color: #9ca3af;
        border: 1px solid #3a3a3a;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
    }

    .date-picker-wrapper {
        position: relative;
    }

    .date-picker-input {
        background: #2a2a2a;
        color: #9ca3af;
        border: 1px solid #3a3a3a;
        padding: 6px 30px 6px 12px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        width: 140px;
    }

    .date-picker-input:hover {
        background: #3a3a3a;
        color: #fff;
    }

    .flatpickr-calendar {
        background: #1a1a1a;
        border: 1px solid #3a3a3a;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .flatpickr-day {
        color: #9ca3af;
    }

    .flatpickr-day:hover {
        background: #2a2a2a;
        color: #fff;
    }

    .flatpickr-day.selected {
        background: #3b82f6;
        color: white;
    }

    .calendar-popup {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 4px;
        background: #1a1a1a;
        border: 1px solid #3a3a3a;
        border-radius: 8px;
        padding: 12px;
        display: none;
        z-index: 1000;
        min-width: 280px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .calendar-popup.show {
        display: block;
    }

    .calendar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }

    .cal-nav-btn {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        border-radius: 4px;
        font-size: 18px;
    }

    .cal-nav-btn:hover {
        background: #2a2a2a;
        color: #fff;
    }

    .cal-month-year {
        color: #fff;
        font-size: 14px;
        font-weight: 500;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
        margin-bottom: 8px;
    }

    .calendar-weekdays div {
        text-align: center;
        color: #6b7280;
        font-size: 11px;
        font-weight: 500;
        padding: 4px;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 2px;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        border-radius: 4px;
        font-size: 13px;
        transition: all 0.2s;
    }

    .calendar-day:hover:not(.disabled) {
        background: #2a2a2a;
        color: #fff;
    }

    .calendar-day.selected {
        background: #3b82f6;
        color: white;
    }

    .calendar-day.today {
        border: 1px solid #3b82f6;
    }

    .calendar-day.disabled {
        color: #4a4a4a;
        cursor: not-allowed;
    }

    .calendar-day.has-recording {
        position: relative;
    }

    .calendar-day.has-recording::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        background: #ef4444;
        border-radius: 50%;
    }

    .zoom-controls {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-left: 12px;
    }

    .zoom-btn {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #2a2a2a;
        border: 1px solid #3a3a3a;
        color: #9ca3af;
        cursor: pointer;
        border-radius: 4px;
        font-size: 18px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .zoom-btn:hover {
        background: #3a3a3a;
        color: #fff;
    }

    .zoom-slider-wrapper {
        width: 80px;
        position: relative;
    }

    /* Dotted track for zoom slider */
    .zoom-slider-wrapper::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-image: repeating-linear-gradient(
            to right,
            #6b7280 0px,
            #6b7280 4px,
            transparent 4px,
            transparent 8px
        );
        transform: translateY(-50%);
        pointer-events: none;
        z-index: 0;
    }

    .zoom-slider {
        width: 100%;
        height: 4px;
        -webkit-appearance: none;
        appearance: none;
        background: transparent;
        border-radius: 2px;
        outline: none;
        position: relative;
        z-index: 1;
    }

    .zoom-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 14px;
        height: 14px;
        background: #3b82f6;
        border-radius: 50%;
        cursor: pointer;
    }

    .zoom-slider::-moz-range-thumb {
        width: 14px;
        height: 14px;
        background: #3b82f6;
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }

    .timeline-wrapper {
        background: #000;
        border-top: 1px solid #1a1a1a;
        padding: 0;
    }

    .timeline-header {
        display: none; /* Hide header for cleaner look */
    }

    .timeline-container {
        position: relative;
        height: 100px;
        background: #000;
        overflow: hidden;
        user-select: none;
        cursor: grab;
    }

    .timeline-container:active {
        cursor: grabbing;
    }

    .timeline-content {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: auto;
        transition: none;
        will-change: transform;
    }

    .timeline-scale {
        position: relative;
        height: 100%;
        z-index: 2;
        pointer-events: none;
    }

    /* Horizontal baseline */
    .timeline-baseline {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #333;
        z-index: 1;
        pointer-events: none;
    }

    /* Vertical tick marks */
    .timeline-tick {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 20px;
        background: #333;
        border-left: 1px dotted #444;
        pointer-events: none;
    }

    .timeline-tick.major {
        height: 30px;
        background: #444;
        border-left: 1px solid #555;
        pointer-events: none;
    }

    /* Time labels */
    .timeline-label {
        position: absolute;
        color: #9ca3af;
        font-size: 12px;
        font-weight: 400;
        white-space: nowrap;
        transform: translateX(-50%);
        top: 15px;
        pointer-events: none;
    }

    /* First label - align to left edge */
    .timeline-label.first {
        transform: translateX(0);
    }

    /* Last label - align to right edge */
    .timeline-label.last {
        transform: translateX(-100%);
    }

    /* Video loader overlay */
    .video-loader {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 100;
    }

    .video-loader .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top-color: #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Date labels */
    .timeline-label.date {
        top: 65px;
        font-size: 11px;
        color: #6b7280;
    }

    /* Fixed center cursor - thin red line */
    .timeline-cursor-fixed {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: 0;
        bottom: 0;
        pointer-events: none;
        z-index: 1000;
    }

    .timeline-cursor-line {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 100%;
        background: #ef4444;
    }

    /* Time display badge - positioned like in the image */
    .timeline-cursor-time {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(10px, -50%);
        background: #ef4444;
        color: white;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        z-index: 1001;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    /* Optional: Arrow pointing to the red line */
    .timeline-cursor-time::before {
        content: '';
        position: absolute;
        right: 100%;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 6px solid #ef4444;
    }

    /* Recording segments on timeline with borders */
    .timeline-recordings {
        position: absolute;
        top: 35%;
        left: 0;
        height: 30%;
        width: 100%;
        border-top: 2px solid #555;
        border-bottom: 2px solid #555;
        background: transparent;
        pointer-events: none;
        z-index: 1;
    }

    .timeline-recording {
        position: absolute;
        height: 100%;
        background: #606670;
        opacity: 1;
        pointer-events: auto;
    }

    .timeline-tick.dotted {
        border-left: 1px dashed #888;
        height: 150%;
        top: -25%;
        opacity: 0.6;
        pointer-events: none;
        z-index: 2;
    }

    .timeline-scrollbar {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: #1a1a1a;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .timeline-container:hover .timeline-scrollbar {
        opacity: 1;
    }

    .timeline-scrollbar-thumb {
        position: absolute;
        height: 100%;
        background: #3a3a3a;
        border-radius: 3px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .timeline-scrollbar-thumb:hover {
        background: #4a4a4a;
    }

    .timeline-cursor-time {
        position: absolute;
        top: 50px;
        left: 50%;
        transform: translateX(-50%);
        background: #3b82f6;
        color: white;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 11px;
        white-space: nowrap;
    }

    .date-display {
        background-color: rgba(55, 65, 81, 0.8);
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #374151;
        color: white;
        cursor: pointer;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
        justify-content: center;
    }

    .date-display:hover {
        background-color: rgba(55, 65, 81, 1);
        border-color: #4B5563;
    }

    .calendar-dropdown {
        position: absolute;
        top: calc(100% + 5px);
        right: 0;
        background-color: #1F2937;
        border: 1px solid #374151;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        z-index: 1000;
        display: none;
        min-width: 280px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-nav {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 18px;
    }

    .calendar-nav:hover {
        background-color: #374151;
    }

    .calendar-month {
        font-weight: 600;
        font-size: 16px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-day-header {
        text-align: center;
        font-size: 12px;
        color: #9CA3AF;
        padding: 8px 4px;
        font-weight: 500;
    }

    .calendar-day {
        text-align: center;
        padding: 8px 4px;
        cursor: pointer;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .calendar-day:hover {
        background-color: #374151;
    }

    .calendar-day.selected {
        background-color: #EF4444;
        color: white;
    }

    .calendar-day.other-month {
        color: #6B7280;
    }

    .zoom-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .zoom-button {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: rgba(55, 65, 81, 0.8);
        border: 1px solid #374151;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .zoom-button:hover {
        background-color: rgba(55, 65, 81, 1);
        border-color: #4B5563;
    }

    .speed-selector {
        background-color: rgba(55, 65, 81, 0.8);
        border: 1px solid #374151;
        color: white;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }

    .speed-selector:hover {
        background-color: rgba(55, 65, 81, 1);
    }

    .volume-control {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .volume-slider {
        width: 80px;
        height: 4px;
        background: #374151;
        border-radius: 2px;
        outline: none;
        -webkit-appearance: none;
    }

    .volume-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 14px;
        height: 14px;
        background: white;
        border-radius: 50%;
        cursor: pointer;
    }

    .no-recording-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #9CA3AF;
        background-color: #111827;
    }

    .no-recording-icon {
        width: 80px;
        height: 80px;
        background-color: #374151;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .no-recording-icon svg {
        width: 40px;
        height: 40px;
        color: #6B7280;
    }
</style>

<div class="flex flex-wrap" style="height: calc(100vh - 120px); width:100%;">
    <!-- Sidebar with projects -->
    <div class="lg:w-1/6 md:w-1/6 sm:w-6/6 w-full">
        <div class="crane-list py-[10px] pl-[5px] pr-[10px] overflow-y-scroll w-full">
            <!-- All Cam View Switch -->
            <div class="mb-[15px] px-[10px]">
                <div class="flex items-center justify-between">
                    <span class="manrope-medium text-[13px] font-medium text-black">All Cam View</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" id="allCamViewSwitch" onchange="toggleAllCamView()" checked>
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                    </label>
                </div>
            </div>
            @foreach($projects as $index => $project)
            <button class="w-full tab-button tab-shadow py-[10px] px-[10px] rounded-[10px] mb-[10px] cursor-pointer hover:bg-green-500 hover:text-white 
                {{ $index == 0 ? 'bg-green-500 text-white active' : 'bg-white text-black' }}"
                style="height:42px;"
                onclick="selectProject({{ $project->project_id }}, this, '{{ $project->project_name }}')">
                <div class="flex">
                    <p class="w-[100%] text-left manrope-medium text-[13px] font-medium mb-[5px]">
                        {{ $project->project_name }}
                    </p>
                </div>
            </button>
            @endforeach
        </div>
    </div>

    <!-- Main content area -->
    <div class="lg:w-5/6 md:w-5/6 sm:w-6/6 mt-[10px] xs:6/6 w-full">
        <!-- Loading indicator -->
        <div id="loadingIndicator" class="text-center" style="display: none;">
            <div class="loading-spinner"></div>
            <p class="text-gray-600">Loading cameras...</p>
        </div>

        <!-- Error message -->
        <div id="errorMessage" class="text-center text-red-600" style="display: none;">
            <p>Error loading project cameras. Please try again.</p>
        </div>

        <!-- All Cameras Grid View (Shown by default - no tabs here) -->
        <div class="all-cam-grid pl-[10px] pr-[10px]" id="allCamGridContainer" style="display: block;">
            <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6" id="allCamGrid">
                <!-- Camera grid items will be populated dynamically -->
            </div>
        </div>

        <!-- Single Camera View with Tabs (Only shown when switching from grid to single camera) -->
        <div id="singleCameraViewContainer" style="display: none;">
            <!-- Main tabs (only visible in single camera view) -->
            <div class="flex mb-0 pl-[10px]" id="mainTabsContainer">
                <button class="main-tab-button active" id="liveViewTab" onclick="switchMainTab('live-view', this)">
                    <img src="{{ asset('admin-theme/assets/images/thum-vid.png') }}" class="w-[25px] object-contain mr-[5px]">
                    Live view
                </button>
                <button class="main-tab-button" id="recordingsTab" onclick="switchMainTab('recordings', this)">
                    <img src="{{ asset('admin-theme/assets/images/record.png') }}" class="w-[25px] object-contain mr-[5px]">
                    Recordings
                </button>
            </div>

            <!-- Tab content containers -->
            <div class="tab-contents px-[10px]">
                <!-- Live View Tab Content -->
                <div id="live-view" class="tab-content active">
                    <!-- Single video player container -->
                    <div class="video-player relative w-full" id="videoPlayerContainer" x-data="{ open: false }">
                        <div class="video-container relative w-full h-full" style="aspect-ratio: 16/9;">
                            <div class="main-video-container w-full h-full" id="mainVideoContainer" style="background-color: #000;">
                                <!-- Main video stream will be inserted here -->
                                <div class="flex items-center justify-center h-full text-white">
                                    <p>Select a camera to start streaming</p>
                                </div>
                            </div>
                        </div>

                        <p id="statusText" class="manrope-medium text-[14px] text-[#344563]">Not connected</p>

                        <!-- Video controls -->
                        <div class="video-controls">
                            <nav class="flex justify-between bg-[#00000054] mt-[-53px] z-[9px] relative pt-[0px] pb-[0px] pl-[20px] pr-[20px]">
                                <div>
                                    <ul class="navbar-nav mr-auto video-volume">
                                        <li class="nav-item">
                                            <div class="volume-control flex">
                                                <img src="{{ asset('admin-theme/assets/images/max-vol.png') }}" alt="Low Volume" class="volume-icon w-[15px] object-contain mr-[5px]">
                                                <input type="range" id="volume-slider" min="0" max="1" step="0.1" value="0.5">
                                                <img src="{{ asset('admin-theme/assets/images/min-vol.png') }}" alt="High Volume" class="volume-icon w-[15px] object-contain ml-[5px]">
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <ul class="flex">
                                        <li class="nav-item">
                                            <button id="play-pause" class="control-btn" onclick="togglePlayPause()">
                                                <img src="{{ asset('admin-theme/assets/images/play.png') }}" class="w-[20px] object-contain mr-[10px]" id="play-pause-icon">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="microphone" class="control-btn" onclick="toggleMute()">
                                                <img src="{{ asset('admin-theme/assets/images/speaker.png') }}" class="w-[20px] object-contain mr-[10px]" id="mute-icon">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="video-speed" class="control-btn">
                                                <img src="{{ asset('admin-theme/assets/images/video-vid.png') }}" class="w-[20px] object-contain mr-[10px]">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="video-cut" class="control-btn">
                                                <img src="{{ asset('admin-theme/assets/images/video-cut.png') }}" class="w-[20px] object-contain mr-[10px]">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="video-record" class="control-btn">
                                                <img src="{{ asset('admin-theme/assets/images/video-record.png') }}" class="w-[20px] object-contain mr-[10px]">
                                            </button>
                                        </li>
                                        <li class="nav-item">
                                            <button id="video-setting-menu" class="control-btn">
                                                <img src="{{ asset('admin-theme/assets/images/video-settings.png') }}" class="w-[20px] object-contain mr-[10px]">
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <ul class="navbar-nav ml-auto flex">
                                        <li class="nav-item">
                                            <div class="size-control flex">
                                                <img src="{{ asset('admin-theme/assets/images/min-size.png') }}" alt="min size" class="size-icon w-[15px] object-contain mr-[5px]">
                                                <input type="range" id="size-slider" min="0" max="1" step="0.1" value="0.5">
                                                <img src="{{ asset('admin-theme/assets/images/max-size.png') }}" alt="max size" class="size-icon w-[15px] object-contain ml-[5px]">
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <button class="control-btn" onclick="toggleFullscreen()">
                                                <img src="{{ asset('admin-theme/assets/images/max-screen.png') }}" class="w-[15px] object-contain ml-[15px]">
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <!-- Camera thumbnails overlay -->
                        <div>
                            <ul x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition transform ease-out duration-300"
                                x-transition:enter-start="-translate-y-10 opacity-0"
                                x-transition:enter-end="translate-y-0 opacity-100"
                                x-transition:leave="transition transform ease-in duration-200"
                                x-transition:leave-start="translate-y-0 opacity-100"
                                x-transition:leave-end="-translate-y-10 opacity-0"
                                class="absolute top-0 bg-[#0000007a] shadow-lg rounded-md p-2 space-y-2 flex justify-center items-center space-x-4 z-[2]"
                                style="width:96.6%;"
                                id="cameraThumbnailsList">
                                <!-- Camera thumbnails will be populated dynamically -->
                            </ul>
                        </div>

                        <!-- Close button for thumbnails -->
                        <div x-show="open" class="absolute top-[20px] right-[30px] cursor-pointer z-[5]" @click="open = false">
                            <p class="flex text-white items-center">
                                <span class="w-[20px] object-contain text-white manrope-medium">X</span>
                            </p>
                        </div>

                        <!-- Camera count button -->
                        <div class="absolute top-[20px] left-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                            <p class="flex text-white text-[20px] cursor-pointer" @click="open = !open">
                                <img src="{{ asset('admin-theme/assets/images/thum-vid.png') }}" class="w-[25px] object-contain mr-[5px]">
                                <span id="cameraCount">0</span>
                            </p>
                        </div>

                        <!-- Weather info -->
                        <div class="absolute top-[30%] right-[30px] bg-[#00000054] lg:py-[45px] md:py-[45px] px-[10px] rounded-full sm:py-[25px]">
                            <div class="text-white text-[20px] cursor-pointer mb-[30px]">
                                <img src="{{ asset('admin-theme/assets/images/weather.png') }}" class="w-[30px] w-[30px] object-contain mx-auto mb-[8px]">
                                <p class="text-white manrope-bold text-[15px] text-center">5'</p>
                            </div>
                            <div class="text-white text-[20px] cursor-pointer">
                                <img src="{{ asset('admin-theme/assets/images/wind.png') }}" class="w-[20px] object-contain mx-auto mb-[8px]">
                                <p class="text-white manrope-bold text-[12px] text-center">15 mph</p>
                            </div>
                        </div>

                        <!-- Online status -->
                        <div x-show="!open" class="online absolute top-[20px] right-[30px] bg-[#00000054] py-[5px] px-[19px] rounded-full">
                            <p class="flex text-white">
                                <img id="camStatImg" src="{{ asset('admin-theme/assets/images/offline.png') }}" class="w-[20px] object-contain mr-[5px]">
                                <span id="onlineStatus">Offline</span>
                            </p>
                        </div>
                    </div>

                    <!-- Recordings Tab Content -->

                </div>
                <div id="recordings" class="tab-content">
                    <div class="recordings-player-container">
                        <!-- Video Player Area -->
                        <div class="recordings-video-wrapper">
                            <!-- Video Player -->
                            <div class="recordings-video-container" id="videoContainer">
                                <video class="recordings-video" id="recordingVideo" preload="metadata">
                                    <source src="{{ asset('admin-theme/assets/videos/motion-detection-computer-room-door-1920x1080.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>

                                <!-- Video Info Overlay -->
                                <div class="recordings-info-overlay" id="videoInfoOverlay">
                                    BC1085.38.190
                                </div>
                            </div>
                        </div>

                        <!-- Controls Bar -->
                        <div class="recordings-controls-bar">
                            <!-- Top Control Bar -->
                            <div class="controls-top-bar">
                                <div class="controls-left">
                                    <button class="control-btn-icon" id="filterBtn" title="No filter">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
                                        </svg>
                                    </button>
                                    <span class="filter-label">No filter</span>
                                    <span class="divider">|</span>
                                    <select class="speed-selector" id="speedSelector">
                                        <option value="auto">Auto</option>
                                        <option value="0.5">0.5x</option>
                                        <option value="1" selected>1x</option>
                                        <option value="2">2x</option>
                                        <option value="4">4x</option>
                                    </select>
                                </div>

                                <div class="controls-center">
                                    <button class="control-btn-icon" id="prevBtn" title="Previous">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z"/>
                                        </svg>
                                    </button>
                                    <button class="control-btn-icon play-btn" id="playPauseBtn" title="Play">
                                        <svg viewBox="0 0 24 24" fill="currentColor" id="playIcon">
                                            <path d="M8 5v14l11-7z" />
                                        </svg>
                                        <svg viewBox="0 0 24 24" fill="currentColor" id="pauseIcon" style="display: none;">
                                            <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                        </svg>
                                    </button>
                                    <button class="control-btn-icon" id="nextBtn" title="Next">
                                        <svg viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z"/>
                                        </svg>
                                    </button>
                                    <select class="speed-selector" id="playbackSpeed">
                                        <option value="1">1x</option>
                                        <option value="2">2x</option>
                                        <option value="4">4x</option>
                                        <option value="8">8x</option>
                                    </select>
                                </div>

                                <div class="controls-right">
                                    <!-- Date Picker -->
                                    <div class="date-picker-wrapper">
                                        <input type="text" class="date-picker-input" id="datePickerInput" readonly>
                                    </div>

                                    <!-- Zoom Controls -->
                                    <div class="zoom-controls">
                                        <button class="zoom-btn" id="zoomOut" title="Zoom Out">−</button>
                                        <div class="zoom-slider-wrapper">
                                            <input type="range" class="zoom-slider" id="zoomSlider" min="1" max="10" value="5">
                                        </div>
                                        <button class="zoom-btn" id="zoomIn" title="Zoom In">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline -->
                            <div class="timeline-wrapper">
                                <div class="timeline-header">
                                    <span class="timeline-camera">BC1085.38.190</span>
                                </div>
                                <div class="timeline-container" id="timelineContainer">
                                    <!-- Moving timeline content -->
                                    <div class="timeline-content" id="timelineContent">
                                        <div class="timeline-scale" id="timelineScale">
                                            <!-- Timeline hours will be generated here -->
                                        </div>
                                        <div class="timeline-recordings" id="timelineRecordings">
                                            <!-- Recording segments will be shown here -->
                                        </div>
                                    </div>
                                    <!-- Fixed center cursor with time badge -->
                                    <div class="timeline-cursor-fixed" id="timelineCursor">
                                        <div class="timeline-cursor-line"></div>
                                        <div class="timeline-cursor-time" id="cursorTime">
                                            <script>
                                                // Display current time initially
                                                const now = new Date();
                                                const hours24 = now.getHours();
                                                const minutes = now.getMinutes();
                                                const seconds = now.getSeconds();
                                                const period = hours24 >= 12 ? 'PM' : 'AM';
                                                const hours12 = hours24 === 0 ? 12 : hours24 > 12 ? hours24 - 12 : hours24;
                                                document.write(`${hours12}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} ${period}`);
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('styles')
    <style>
        .tab-prop {
            min-height: 400px;
        }

        video {
            width: 100%;
            height: auto;
            border-radius: 8px;
            background-color: #000;
        }
    </style>
    @endpush

    @push('scripts')
    <!-- Firebase SDK -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-app-compat.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/9.22.0/firebase-firestore-compat.min.js"></script>

    <script>
        // Firebase Configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDmY8h7dV4C68p_WQFDlAoOcinLOl6HslM",
            authDomain: "hook-camera.firebaseapp.com",
            projectId: "hook-camera",
            storageBucket: "hook-camera.firebasestorage.app",
            messagingSenderId: "898999390945",
            appId: "1:898999390945:web:753f1c82e3952672e01da0",
            measurementId: "G-X7SDBG134T"
        };

        // Initialize Firebase
        let app, db;
        try {
            app = firebase.initializeApp(firebaseConfig);
            db = firebase.firestore();
            console.log('Firebase initialized successfully');
        } catch (error) {
            console.error('Firebase initialization error:', error);
        }

        // Firebase Camera Control Functions
        async function updateCameraControlData(cameraId, isStart, actionBy = 100) {
            // alert();
            if (!db) {
                console.error('Firebase not initialized');
                return false;
            }

            try {
                const cameraDocRef = db.collection('camera').doc(cameraId.toString());

                const updateData = {
                    actionBy: actionBy,
                    isStart: isStart,
                    lastUpdated: firebase.firestore.FieldValue.serverTimestamp()
                };

                await cameraDocRef.update(updateData);

                console.log(`Camera ${cameraId} control data updated:`, {
                    actionBy: actionBy,
                    isStart: isStart
                });

                return true;
            } catch (error) {
                console.error(`Error updating camera ${cameraId} control data:`, error);

                // If document doesn't exist, create it
                if (error.code === 'not-found') {
                    try {
                        await db.collection('camera').doc(cameraId.toString()).set({
                            actionBy: actionBy,
                            isStart: isStart,
                            createdAt: firebase.firestore.FieldValue.serverTimestamp(),
                            lastUpdated: firebase.firestore.FieldValue.serverTimestamp()
                        });
                        console.log(`Camera ${cameraId} document created with control data`);
                        return true;
                    } catch (createError) {
                        console.error(`Error creating camera ${cameraId} document:`, createError);
                        return false;
                    }
                }

                return false;
            }
        }

        // Get current camera ID
        function getCurrentCameraId() {
            if (projectConnection) {
                const mainCamera = Object.values(projectConnection.cameras).find(camera => camera.isMainCamera);
                if (mainCamera) {
                    return mainCamera.cameraId;
                }
            }

            if (currentProject && currentProject.cameras && currentProject.cameras.length > 0) {
                return currentProject.cameras[0].id;
            }

            return "23"; // Fallback camera ID
        }

        // Main tab switching function
        function switchMainTab(tabName, buttonElement) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });

            // Remove active class from all tab buttons
            const tabButtons = document.querySelectorAll('.main-tab-button');
            tabButtons.forEach(button => {
                button.classList.remove('active');
            });

            // Show selected tab content
            const selectedTab = document.getElementById(tabName);
            if (selectedTab) {
                selectedTab.classList.add('active');
            }

            // Add active class to clicked button
            buttonElement.classList.add('active');

            // If switching to recordings tab, load recordings for current date
            if (tabName === 'recordings' && window.recordingsPlayer) {
                window.recordingsPlayer.loadRecordingsForDate(window.recordingsPlayer.currentDate);
                // Update cursor time to current time when switching to recordings tab
                window.recordingsPlayer.initializeCursorTime();
            }

            console.log(`Switched to ${tabName} tab`);

            // If switching to live view and all cam view is disabled, ensure single player is shown
            if (tabName === 'live-view' && !isAllCamViewEnabled) {
                document.getElementById('videoPlayerContainer').style.display = 'block';
            }

            if (tabName === 'recordings') {
                setTimeout(() => {
                    initializeRecordingsPlayer();
                }, 100);
            }

            // If switching to live view and all cam view is disabled, ensure single player is shown
            if (tabName === 'live-view' && !isAllCamViewEnabled) {
                document.getElementById('videoPlayerContainer').style.display = 'block';
            }
        }

        // Janus Gateway REST API integration
        const JANUS_URL = "https://unnifyy.com:8089/janus";

        // Global state management
        let currentProject = null;
        let projectConnection = null;
        let currentCameras = [];
        let activeTab = null;
        let isAllCamViewEnabled = true;
        let gridConnections = {};

        // Utility functions
        function randStr() {
            return Math.random().toString(36).substring(2, 12);
        }

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        async function janusPost(endpoint, body) {
            try {
                const res = await fetch(`${JANUS_URL}${endpoint}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(body),
                });
                return await res.json();
            } catch (error) {
                console.error("Janus POST error:", error);
                throw error;
            }
        }

        // Toggle All Cam View
        async function toggleAllCamView() {
            const allCamSwitch = document.getElementById('allCamViewSwitch');
            const allCamGridContainer = document.getElementById('allCamGridContainer');
            const singleCameraViewContainer = document.getElementById('singleCameraViewContainer');

            isAllCamViewEnabled = allCamSwitch.checked;

            if (isAllCamViewEnabled) {
                // Show all cam grid, hide single camera view with tabs
                allCamGridContainer.style.display = 'block';
                singleCameraViewContainer.style.display = 'none';

                // If we have current cameras, populate the grid
                if (currentCameras && currentCameras.length > 0) {
                    populateAllCamGrid(currentCameras);
                }

                // Disconnect single view connection if exists
                if (projectConnection) {
                    await projectConnection.disconnect();
                    projectConnection = null;
                }
            } else {
                // Show single camera view with tabs, hide all cam grid
                allCamGridContainer.style.display = 'none';
                singleCameraViewContainer.style.display = 'block';

                // Ensure live view tab is active by default
                switchMainTab('live-view', document.getElementById('liveViewTab'));

                // Disconnect all grid connections
                await disconnectAllGridCameras();

                // Initialize single view if not already
                if (currentCameras && currentCameras.length > 0) {
                    createCameraThumbnails(currentCameras);

                    if (!projectConnection) {
                        projectConnection = new ProjectConnection(currentProject);
                        await projectConnection.initializeAllCameras();
                    }
                }
            }
        }

        // Populate All Cam Grid
        function populateAllCamGrid(cameras) {
            const allCamGrid = document.getElementById('allCamGrid');
            if (!allCamGrid) return;

            allCamGrid.innerHTML = '';

            if (!cameras || cameras.length === 0) {
                allCamGrid.innerHTML = `
                <div class="col-span-full text-center">
                    <p class="manrope-medium text-[16px] text-[#344563]">No cameras available for this project.</p>
                </div>
            `;
                return;
            }

            cameras.forEach((camera, index) => {
                const gridItem = document.createElement('div');
                gridItem.className = 'camera-grid-item';
                gridItem.id = `grid-camera-${camera.id}`;

                gridItem.innerHTML = `
                <div class="camera-offline" id="offline-${camera.id}">
                    <p class="text-white">No stream available</p>
                </div>
                <div class="camera-live-indicator" style="display: none;" id="live-indicator-${camera.id}">
                    <p class="flex manrope-medium font-semibold text-red-500">
                        <img src="{{ asset('admin-theme/assets/images/live-reco.png') }}" class="w-[15px] object-contain mr-[3px] mt-[-1px]"> Live
                    </p>
                </div>
                <div class="camera-name-label">
                    <span class="manrope-medium text-white">${camera.camera_name}</span>
                </div>
                <div class="camera-status-indicator status-disconnected" id="grid-status-${camera.id}"></div>
            `;

                // Add click handler to switch to single view
                gridItem.addEventListener('click', () => {
                    switchToSingleView(camera.id);
                });

                allCamGrid.appendChild(gridItem);

                // Connect camera with delay to avoid overload
                setTimeout(() => {
                    connectGridCamera(camera, index * 2000); // Stagger connections by 2 seconds
                }, 100);
            });
        }

        // Connect individual grid camera
        async function connectGridCamera(camera, delay = 0) {
            await sleep(delay);

            console.log(`[GRID] Connecting camera ${camera.id}...`);

            try {
                const gridCamera = new CameraConnection(camera.id, camera.camera_name, false);
                gridCamera.isGridMode = true;
                gridConnections[camera.id] = gridCamera;

                const sessionCreated = await gridCamera.createSession();
                if (sessionCreated) {
                    const pluginAttached = await gridCamera.attachPlugin();
                    if (pluginAttached) {
                        await gridCamera.listParticipants();
                    }
                }
            } catch (error) {
                console.error(`[GRID] Failed to connect camera ${camera.id}:`, error);
            }
        }

        // Disconnect all grid cameras
        async function disconnectAllGridCameras() {
            console.log('[GRID] Disconnecting all grid cameras...');

            const disconnectPromises = Object.values(gridConnections).map(camera => camera.disconnect());
            await Promise.all(disconnectPromises);

            gridConnections = {};
        }

        // Switch from all cam view to single view
        async function switchToSingleView(cameraId) {
            const allCamSwitch = document.getElementById('allCamViewSwitch');
            allCamSwitch.checked = false;
            await toggleAllCamView();
            if (projectConnection) {
                projectConnection.switchMainCamera(cameraId);
            }
        }

        // Camera connection class (modified for grid support)
        class CameraConnection {
            constructor(cameraId, cameraName, isMainCamera = false) {
                this.cameraId = cameraId;
                this.cameraName = cameraName;
                this.roomId = cameraId;
                this.isMainCamera = isMainCamera;
                this.isGridMode = false;
                this.sessionId = null;
                this.handleId = null;
                this.feedId = null;
                this.pc = null;
                this.videoElement = null;
                this.isPolling = false;
                this.isConnected = false;
            }

            async createSession() {
                try {
                    const res = await janusPost("", {
                        janus: "create",
                        transaction: randStr()
                    });
                    this.sessionId = res.data.id;
                    console.log(`[CAMERA ${this.cameraId}] Created session:`, this.sessionId);
                    this.pollEvents();
                    return true;
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] Session creation failed:`, error);
                    return false;
                }
            }

            async attachPlugin() {
                try {
                    const res = await janusPost(`/${this.sessionId}`, {
                        janus: "attach",
                        plugin: "janus.plugin.videoroom",
                        transaction: randStr()
                    });
                    this.handleId = res.data.id;
                    console.log(`[CAMERA ${this.cameraId}] Attached to plugin:`, this.handleId);
                    return true;
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] Plugin attachment failed:`, error);
                    return false;
                }
            }

            async joinAsSubscriber(feedId) {
                this.feedId = feedId;
                console.log(`[CAMERA ${this.cameraId}] Joining as subscriber to feed:`, feedId, 'in room:', this.roomId);

                try {
                    await janusPost(`/${this.sessionId}/${this.handleId}`, {
                        janus: "message",
                        body: {
                            request: "join",
                            ptype: "subscriber",
                            room: this.roomId,
                            feed: feedId
                        },
                        transaction: randStr()
                    });

                    this.updateStatus("Connecting...");
                    return true;
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] Join failed:`, error);
                    this.updateStatus("Connection failed");
                    return false;
                }
            }

            async startSubscriber(jsep) {
                try {
                    this.pc = new RTCPeerConnection({
                        iceServers: [{
                            urls: "stun:stun.l.google.com:19302"
                        }]
                    });

                    this.pc.ontrack = (e) => {
                        console.log(`[CAMERA ${this.cameraId}] Received remote track`);
                        this.handleRemoteStream(e.streams[0]);
                    };

                    this.pc.onicecandidate = async (event) => {
                        if (event.candidate) {
                            await janusPost(`/${this.sessionId}/${this.handleId}`, {
                                janus: "trickle",
                                candidate: event.candidate,
                                transaction: randStr()
                            });
                        } else {
                            await janusPost(`/${this.sessionId}/${this.handleId}`, {
                                janus: "trickle",
                                candidate: {
                                    completed: true
                                },
                                transaction: randStr()
                            });
                        }
                    };

                    await this.pc.setRemoteDescription(jsep);
                    const answer = await this.pc.createAnswer();
                    await this.pc.setLocalDescription(answer);

                    await janusPost(`/${this.sessionId}/${this.handleId}`, {
                        janus: "message",
                        body: {
                            request: "start",
                            room: this.roomId
                        },
                        jsep: answer,
                        transaction: randStr()
                    });

                    console.log(`[CAMERA ${this.cameraId}] Sent SDP answer for room:`, this.roomId);
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] StartSubscriber error:`, error);
                    this.updateStatus("Connection failed");
                }
            }

            handleRemoteStream(stream) {
                // Create video element
                const videoElement = document.createElement("video");
                videoElement.autoplay = true;
                videoElement.playsInline = true;
                videoElement.controls = false;
                videoElement.muted = true;
                videoElement.style.width = '100%';
                videoElement.style.height = '100%';
                videoElement.style.objectFit = 'cover';
                videoElement.style.display = 'block';
                videoElement.style.borderRadius = '8px';
                videoElement.id = `video-${this.cameraId}-element`;

                // Attach stream to video element
                videoElement.srcObject = stream;
                this.videoElement = videoElement;

                if (this.isGridMode) {
                    this.placeInGridContainer();
                } else {
                    // Always place in thumbnail container first
                    this.placeInThumbnailContainer();

                    // If this is the main camera, also place in main container
                    if (this.isMainCamera) {
                        this.placeInMainContainer();
                    }
                }

                this.isConnected = true;
                this.updateStatus("Connected");
            }

            placeInGridContainer() {
                const gridContainer = document.getElementById(`grid-camera-${this.cameraId}`);
                const offlineDiv = document.getElementById(`offline-${this.cameraId}`);
                const liveIndicator = document.getElementById(`live-indicator-${this.cameraId}`);

                if (gridContainer && this.videoElement) {
                    // Hide offline message
                    if (offlineDiv) {
                        offlineDiv.style.display = 'none';
                    }

                    // Show live indicator
                    if (liveIndicator) {
                        liveIndicator.style.display = 'block';
                    }

                    // Add video element
                    const gridVideo = this.videoElement.cloneNode();
                    gridVideo.srcObject = this.videoElement.srcObject;
                    gridVideo.muted = true;
                    gridContainer.insertBefore(gridVideo, gridContainer.firstChild);
                }
            }

            placeInMainContainer() {
                const mainVideo = document.getElementById('mainVideoContainer');
                if (mainVideo && this.videoElement) {
                    mainVideo.innerHTML = '';
                    const mainVideoElement = this.videoElement.cloneNode();
                    mainVideoElement.srcObject = this.videoElement.srcObject;
                    mainVideoElement.muted = false;
                    mainVideo.appendChild(mainVideoElement);
                    this.setupVolumeControl();
                    this.updateOnlineStatus("Online");
                }
            }

            placeInThumbnailContainer() {
                const thumbnailContainer = document.getElementById(`video-${this.cameraId}`);
                if (thumbnailContainer && this.videoElement) {
                    thumbnailContainer.innerHTML = '';
                    const thumbnailVideo = this.videoElement.cloneNode();
                    thumbnailVideo.muted = true;
                    thumbnailVideo.srcObject = this.videoElement.srcObject;
                    thumbnailContainer.appendChild(thumbnailVideo);
                }
            }

            moveToMainContainer() {
                if (this.videoElement && this.isConnected) {
                    this.isMainCamera = true;
                    this.placeInMainContainer();

                    // Update other cameras to not be main
                    if (projectConnection) {
                        Object.values(projectConnection.cameras).forEach(camera => {
                            if (camera.cameraId !== this.cameraId) {
                                camera.isMainCamera = false;
                            }
                        });
                    }
                }
            }

            setupVolumeControl() {
                const mainVideo = document.querySelector('#mainVideoContainer video');
                if (mainVideo) {
                    const volumeSlider = document.getElementById('volume-slider');
                    if (volumeSlider) {
                        mainVideo.volume = volumeSlider.value;
                        volumeSlider.addEventListener('input', () => {
                            mainVideo.volume = volumeSlider.value;
                        });
                    }
                }
            }

            async pollEvents() {
                if (this.isPolling) return;
                this.isPolling = true;

                while (this.sessionId && this.isPolling) {
                    try {
                        const res = await fetch(`${JANUS_URL}/${this.sessionId}?rid=${Date.now()}&maxev=1`);
                        const data = await res.json();

                        if (data.janus === "event") {
                            const pluginData = data.plugindata?.data;

                            if (pluginData?.videoroom === "event" && pluginData.publishers?.length > 0) {
                                const feedId = pluginData.publishers[0].id;
                                console.log(`[CAMERA ${this.cameraId}] Found publisher feed ID:`, feedId);
                                await this.joinAsSubscriber(feedId);
                            }

                            if (data.jsep) {
                                console.log(`[CAMERA ${this.cameraId}] Got JSEP offer`);
                                await this.startSubscriber(data.jsep);
                            }
                        }
                    } catch (err) {
                        console.error(`[CAMERA ${this.cameraId}] Polling error:`, err);
                    }

                    await sleep(500);
                }
            }

            async listParticipants() {
                try {
                    const res = await janusPost(`/${this.sessionId}/${this.handleId}`, {
                        janus: "message",
                        body: {
                            request: "listparticipants",
                            room: this.roomId
                        },
                        transaction: randStr()
                    });

                    const data = res.plugindata?.data;
                    if (data?.videoroom === "participants") {
                        const publishers = data.participants.filter(p => p.publisher);
                        if (publishers.length > 0) {
                            const feedId = publishers[0].id;
                            console.log(`[CAMERA ${this.cameraId}] Found publisher via list:`, feedId, 'in room:', this.roomId);
                            await this.joinAsSubscriber(feedId);
                        }
                    }
                } catch (error) {
                    console.error(`[CAMERA ${this.cameraId}] List participants error:`, error);
                }
            }

            updateStatus(status) {
                const statusElement = document.getElementById(`status-${this.cameraId}`);
                if (statusElement) {
                    statusElement.className = `video-status ${
                    status === 'Connected' ? 'status-connected' :
                    status === 'Connecting...' ? 'status-connecting' :
                    'status-disconnected'
                }`;
                }

                // Update grid status if in grid mode
                if (this.isGridMode) {
                    const gridStatusElement = document.getElementById(`grid-status-${this.cameraId}`);
                    if (gridStatusElement) {
                        gridStatusElement.className = `camera-status-indicator ${
                        status === 'Connected' ? 'status-connected' :
                        status === 'Connecting...' ? 'status-connecting' :
                        'status-disconnected'
                    }`;
                    }
                }

                // Update main status if this is main camera
                if (this.isMainCamera) {
                    const mainStatusElement = document.getElementById('statusText');
                    if (mainStatusElement) {
                        mainStatusElement.textContent = status;
                    }
                }
            }

            updateOnlineStatus(status) {
                if (this.isMainCamera) {
                    const onlineElement = document.getElementById('onlineStatus');
                    if (onlineElement) {
                        onlineElement.textContent = status;
                    }
                    if (status == "Online") {
                        camStatImg.src = "{{ asset('admin-theme/assets/images/online.png') }}";
                    } else {
                        camStatImg.src = "{{ asset('admin-theme/assets/images/offline.png') }}";
                    }
                }
            }

            async disconnect() {
                this.isPolling = false;
                this.isConnected = false;

                if (this.pc) {
                    this.pc.close();
                    this.pc = null;
                }

                if (this.videoElement) {
                    this.videoElement.srcObject = null;
                    this.videoElement = null;
                }

                if (this.sessionId) {
                    try {
                        await janusPost(`/${this.sessionId}`, {
                            janus: "destroy",
                            transaction: randStr()
                        });
                    } catch (error) {
                        console.error(`[CAMERA ${this.cameraId}] Session destroy error:`, error);
                    }
                    this.sessionId = null;
                }

                this.updateStatus("Disconnected");
                if (this.isMainCamera) {
                    this.updateOnlineStatus("Offline");
                }

                // Clean up grid view if needed
                if (this.isGridMode) {
                    const gridContainer = document.getElementById(`grid-camera-${this.cameraId}`);
                    const offlineDiv = document.getElementById(`offline-${this.cameraId}`);
                    const liveIndicator = document.getElementById(`live-indicator-${this.cameraId}`);

                    if (gridContainer) {
                        // Remove video element
                        const video = gridContainer.querySelector('video');
                        if (video) {
                            video.remove();
                        }

                        // Show offline message
                        if (offlineDiv) {
                            offlineDiv.style.display = 'flex';
                        }

                        // Hide live indicator
                        if (liveIndicator) {
                            liveIndicator.style.display = 'none';
                        }
                    }
                }
            }
        }

        // Project connection manager
        class ProjectConnection {
            constructor(projectData) {
                this.projectId = projectData.project_id;
                this.projectName = projectData.project_name;
                this.cameras = {};
                this.isInitialized = false;

                // Initialize camera connections
                projectData.cameras.forEach((camera, index) => {
                    const isMainCamera = index === 0; // First camera is main by default
                    this.cameras[camera.id] = new CameraConnection(camera.id, camera.camera_name, isMainCamera);
                });
            }

            async initializeAllCameras() {
                if (this.isInitialized) return;

                console.log(`[PROJECT ${this.projectId}] Initializing all cameras...`);

                // Initialize all cameras
                const initPromises = Object.values(this.cameras).map(async (camera) => {
                    const sessionCreated = await camera.createSession();
                    if (sessionCreated) {
                        const pluginAttached = await camera.attachPlugin();
                        if (pluginAttached) {
                            await camera.listParticipants();
                        }
                    }
                });

                await Promise.all(initPromises);
                this.isInitialized = true;

                console.log(`[PROJECT ${this.projectId}] All cameras initialized`);
            }

            switchMainCamera(cameraId) {
                const targetCamera = this.cameras[cameraId];
                if (targetCamera && targetCamera.isConnected) {
                    // Set all cameras to not main
                    Object.values(this.cameras).forEach(camera => {
                        camera.isMainCamera = false;
                    });

                    // Move target camera to main container
                    targetCamera.moveToMainContainer();

                    console.log(`[PROJECT ${this.projectId}] Switched main camera to:`, cameraId);
                }
            }

            async disconnect() {
                console.log(`[PROJECT ${this.projectId}] Disconnecting all cameras...`);

                const disconnectPromises = Object.values(this.cameras).map(camera => camera.disconnect());
                await Promise.all(disconnectPromises);

                this.isInitialized = false;
            }

            getMainCameraVideoElement() {
                const mainCamera = Object.values(this.cameras).find(camera => camera.isMainCamera);
                return mainCamera ? mainCamera.videoElement : null;
            }
        }

        // AJAX function to get project cameras
        function fetchProjectCameras(projectId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ route('streams.project.cameras', ':projectId') }}".replace(':projectId', projectId),
                    method: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        if (data.success) {
                            resolve(data.project);
                        } else {
                            reject(new Error(data.message || 'Failed to fetch cameras'));
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        reject(new Error('Error fetching project cameras: ' + error));
                    }
                });
            });
        }

        // Function to create camera thumbnails
        function createCameraThumbnails(cameras) {
            const thumbnailsList = document.getElementById('cameraThumbnailsList');
            if (!thumbnailsList) return;

            thumbnailsList.innerHTML = '';

            cameras.forEach(camera => {
                const listItem = document.createElement('li');
                listItem.className = 'mb-[2px] w-[10%]';

                listItem.innerHTML = `
                <div class="cursor-pointer" onclick="switchCamera('${camera.id}')">
                    <div class="video-box w-full" id="video-box-${camera.id}">
                        <div id="video-${camera.id}"></div>
                        <div class="video-info">
                            <div class="video-status status-connecting" id="status-${camera.id}"></div>
                        </div>
                    </div>
                    <p class="manrope-medium bg-[white] text-[13px] inline-block w-full py-[1px] mb-0 text-center pl-[5px] pr-[5px]">
                        ${camera.camera_name}
                    </p>
                </div>
            `;

                thumbnailsList.appendChild(listItem);
            });

            // Update camera count
            const cameraCountElement = document.getElementById('cameraCount');
            if (cameraCountElement) {
                cameraCountElement.textContent = cameras.length;
            }
        }

        // Main function to select and load a project
        async function selectProject(projectId, buttonElement, projectName) {
            try {
                // Update active tab
                if (activeTab) {
                    activeTab.classList.remove('active', 'bg-green-500', 'text-white');
                    activeTab.classList.add('bg-white', 'text-black');
                }

                buttonElement.classList.add('active', 'bg-green-500', 'text-white');
                buttonElement.classList.remove('bg-white', 'text-black');
                activeTab = buttonElement;

                // Show loading
                document.getElementById('loadingIndicator').style.display = 'block';
                document.getElementById('errorMessage').style.display = 'none';
                document.getElementById('videoPlayerContainer').style.display = 'none';
                document.getElementById('allCamGridContainer').style.display = 'none';

                // Disconnect previous project if exists
                if (projectConnection) {
                    await projectConnection.disconnect();
                    projectConnection = null;
                }

                // Disconnect grid cameras if any
                await disconnectAllGridCameras();

                // Fetch project cameras via AJAX
                const projectData = await fetchProjectCameras(projectId);

                if (!projectData.cameras || projectData.cameras.length === 0) {
                    throw new Error('No cameras found for this project');
                }

                // Store current project data
                currentProject = projectData;
                currentCameras = projectData.cameras;

                // Show appropriate view based on switch state
                document.getElementById('loadingIndicator').style.display = 'none';

                await toggleAllCamView();

                console.log(`Project ${projectName} loaded with ${projectData.cameras.length} cameras`);

            } catch (error) {
                console.error('Error selecting project:', error);

                // Show error message
                document.getElementById('loadingIndicator').style.display = 'none';
                document.getElementById('errorMessage').style.display = 'block';
                document.getElementById('allCamGridContainer').style.display = 'none';
                document.getElementById('singleCameraViewContainer').style.display = 'none';

                // Reset main container
                const mainVideoContainer = document.getElementById('mainVideoContainer');
                if (mainVideoContainer) {
                    mainVideoContainer.innerHTML = `
                    <div class="flex items-center justify-center h-full text-white">
                        <p>Error loading cameras. Please try again.</p>
                    </div>
                `;
                }
            }
        }

        // Function to switch main camera
        async function switchCamera(cameraId) {
            console.log(`Switching to camera ${cameraId}`);

            if (projectConnection) {
                projectConnection.switchMainCamera(cameraId);
            }
        }

        // Video control functions with Firebase integration
        async function togglePlayPause() {
            const mainVideo = document.querySelector('#mainVideoContainer video');
            const currentCameraId = getCurrentCameraId();

            if (!currentCameraId) {
                console.error('No current camera ID available');
                return;
            }

            if (mainVideo) {
                const playPauseIcon = document.getElementById('play-pause-icon');
                let newPlayState;
                let actionText;
                let confirmTitle;
                let confirmText;

                // Determine current state and set confirmation messages
                if (mainVideo.paused) {
                    actionText = 'start';
                    confirmTitle = 'Start Camera Stream?';
                    confirmText = 'Are you sure you want to start the camera stream?';
                    newPlayState = true;
                } else {
                    actionText = 'stop';
                    confirmTitle = 'Stop Camera Stream?';
                    confirmText = 'Are you sure you want to stop the camera stream?';
                    newPlayState = false;
                }

                // Show SweetAlert confirmation
                const result = await Swal.fire({
                    title: confirmTitle,
                    text: confirmText,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `Yes, ${actionText} it!`,
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    focusCancel: true
                });

                // Only proceed if user confirmed
                if (result.isConfirmed) {
                    try {
                        if (newPlayState) {
                            // Starting the camera - need to reconnect
                            console.log(`Starting camera ${currentCameraId} - reconnecting...`);

                            // Show loading state
                            const mainVideoContainer = document.getElementById('mainVideoContainer');
                            if (mainVideoContainer) {
                                mainVideoContainer.innerHTML = `
                            <div class="flex items-center justify-center h-full text-white">
                                <div class="text-center">
                                    <div class="loading-spinner mb-4"></div>
                                    <p>Reconnecting camera stream...</p>
                                </div>
                            </div>
                        `;
                            }

                            // Update Firebase first
                            const updateSuccess = await updateCameraControlData(currentCameraId, newPlayState, 100);

                            if (updateSuccess) {
                                // Reconnect the camera
                                await reconnectMainCamera(currentCameraId);

                                // Update play/pause icon
                                if (playPauseIcon) {
                                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/pause.png') }}";
                                }

                                // Show success message
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Camera stream has been started successfully.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                throw new Error('Failed to update camera control in Firebase');
                            }
                        } else {
                            // Stopping the camera
                            console.log(`Stopping camera ${currentCameraId}...`);

                            // Pause the video first
                            mainVideo.pause();

                            // Update Firebase
                            const updateSuccess = await updateCameraControlData(currentCameraId, newPlayState, 100);

                            if (updateSuccess) {
                                // Disconnect the current camera connection
                                if (projectConnection && projectConnection.cameras[currentCameraId]) {
                                    await projectConnection.cameras[currentCameraId].disconnect();
                                }

                                // Update UI
                                if (playPauseIcon) {
                                    playPauseIcon.src = "{{ asset('admin-theme/assets/images/play.png') }}";
                                }

                                // Show stopped state in main container
                                const mainVideoContainer = document.getElementById('mainVideoContainer');
                                if (mainVideoContainer) {
                                    mainVideoContainer.innerHTML = `
                                <div class="flex items-center justify-center h-full text-white">
                                    <p>Camera stream stopped</p>
                                </div>
                            `;
                                }

                                // Update status
                                const statusElement = document.getElementById('statusText');
                                if (statusElement) {
                                    statusElement.textContent = 'Stopped';
                                }

                                const onlineStatusElement = document.getElementById('onlineStatus');
                                if (onlineStatusElement) {
                                    onlineStatusElement.textContent = 'Offline';
                                }

                                const camStatImg = document.getElementById('camStatImg');
                                if (camStatImg) {
                                    camStatImg.src = "{{ asset('admin-theme/assets/images/offline.png') }}";
                                }

                                // Show success message
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Camera stream has been stopped successfully.',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                throw new Error('Failed to update camera control in Firebase');
                            }
                        }
                    } catch (error) {
                        console.error('Error toggling play/pause:', error);

                        // Show error message
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'An error occurred while controlling the camera. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        // Reset to error state in main container
                        const mainVideoContainer = document.getElementById('mainVideoContainer');
                        if (mainVideoContainer) {
                            mainVideoContainer.innerHTML = `
                        <div class="flex items-center justify-center h-full text-white">
                            <p>Error controlling camera. Please try again.</p>
                        </div>
                    `;
                        }
                    }
                } else {
                    // User cancelled - show cancellation message (optional)
                    console.log('User cancelled the action');
                }
            } else {
                // No video element found - this means we need to start a fresh connection
                const result = await Swal.fire({
                    title: 'Start Camera Stream?',
                    text: 'No video stream is currently active. Would you like to start the camera stream?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, start it!',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true,
                    focusCancel: true
                });

                if (result.isConfirmed) {
                    try {
                        // Show loading state
                        const mainVideoContainer = document.getElementById('mainVideoContainer');
                        if (mainVideoContainer) {
                            mainVideoContainer.innerHTML = `
                        <div class="flex items-center justify-center h-full text-white">
                            <div class="text-center">
                                <div class="loading-spinner mb-4"></div>
                                <p>Starting camera stream...</p>
                            </div>
                        </div>
                    `;
                        }

                        // Update Firebase and reconnect
                        const updateSuccess = await updateCameraControlData(currentCameraId, true, 100);

                        if (updateSuccess) {
                            await reconnectMainCamera(currentCameraId);

                            const playPauseIcon = document.getElementById('play-pause-icon');
                            if (playPauseIcon) {
                                playPauseIcon.src = "{{ asset('admin-theme/assets/images/pause.png') }}";
                            }

                            Swal.fire({
                                title: 'Success!',
                                text: 'Camera stream has been started successfully.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            throw new Error('Failed to update camera control in Firebase');
                        }
                    } catch (error) {
                        console.error('Error starting camera:', error);

                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to start camera stream. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });

                        // Reset to error state
                        const mainVideoContainer = document.getElementById('mainVideoContainer');
                        if (mainVideoContainer) {
                            mainVideoContainer.innerHTML = `
                        <div class="flex items-center justify-center h-full text-white">
                            <p>Error starting camera. Please try again.</p>
                        </div>
                    `;
                        }
                    }
                }
            }
        }

        // Function to reconnect the main camera
        async function reconnectMainCamera(cameraId) {
            console.log(`Reconnecting main camera ${cameraId}...`);

            try {
                if (!projectConnection) {
                    throw new Error('No project connection available');
                }

                const camera = projectConnection.cameras[cameraId];
                if (!camera) {
                    throw new Error(`Camera ${cameraId} not found in project`);
                }

                // Disconnect if already connected
                if (camera.isConnected) {
                    await camera.disconnect();
                    // Wait a bit for cleanup
                    await sleep(1000);
                }

                // Reset camera state
                camera.isMainCamera = true;
                camera.isConnected = false;
                camera.sessionId = null;
                camera.handleId = null;
                camera.feedId = null;
                camera.pc = null;
                camera.videoElement = null;
                camera.isPolling = false;

                // Update status to connecting
                camera.updateStatus("Connecting...");

                // Create new session
                const sessionCreated = await camera.createSession();
                if (!sessionCreated) {
                    throw new Error('Failed to create camera session');
                }

                // Attach plugin
                const pluginAttached = await camera.attachPlugin();
                if (!pluginAttached) {
                    throw new Error('Failed to attach camera plugin');
                }

                // List participants to start connection
                await camera.listParticipants();

                console.log(`Camera ${cameraId} reconnection initiated successfully`);

                // Set timeout to check if connection was successful
                setTimeout(() => {
                    if (!camera.isConnected) {
                        console.warn(`Camera ${cameraId} connection timeout - retrying...`);
                        // Optionally retry connection here
                        reconnectMainCamera(cameraId);
                    }
                }, 10000); // 10 second timeout

                return true;

            } catch (error) {
                console.error(`Failed to reconnect camera ${cameraId}:`, error);

                // Show error state in main container
                const mainVideoContainer = document.getElementById('mainVideoContainer');
                if (mainVideoContainer) {
                    mainVideoContainer.innerHTML = `
                <div class="flex items-center justify-center h-full text-white">
                    <p>Failed to reconnect camera. Please try again.</p>
                </div>
            `;
                }

                throw error;
            }
        }

        // Helper function to reinitialize a single camera connection
        async function reinitializeCameraConnection(cameraId) {
            if (!currentProject || !currentProject.cameras) {
                throw new Error('No current project data available');
            }

            const cameraData = currentProject.cameras.find(cam => cam.id == cameraId);
            if (!cameraData) {
                throw new Error(`Camera data not found for ID: ${cameraId}`);
            }

            // Create new camera connection
            const newCamera = new CameraConnection(cameraId, cameraData.camera_name, true);

            // Replace in project connection
            if (projectConnection) {
                // Disconnect old camera if exists
                if (projectConnection.cameras[cameraId]) {
                    await projectConnection.cameras[cameraId].disconnect();
                }

                // Replace with new camera
                projectConnection.cameras[cameraId] = newCamera;
            }

            return newCamera;
        }

        function toggleMute() {
            const mainVideo = document.querySelector('#mainVideoContainer video');
            if (mainVideo) {
                const muteIcon = document.getElementById('mute-icon');
                const volumeSlider = document.getElementById('volume-slider');

                if (mainVideo.muted) {
                    mainVideo.muted = false;
                    if (muteIcon) {
                        muteIcon.src = "{{ asset('admin-theme/assets/images/speaker.png') }}";
                    }
                    if (volumeSlider) {
                        mainVideo.volume = volumeSlider.value;
                    }
                } else {
                    mainVideo.muted = true;
                    if (muteIcon) {
                        muteIcon.src = "{{ asset('admin-theme/assets/images/speaker-n.png') }}";
                    }
                }
            }
        }

        function toggleFullscreen() {
            const videoContainer = document.getElementById('mainVideoContainer');
            if (videoContainer) {
                if (!document.fullscreenElement) {
                    videoContainer.requestFullscreen().catch(err => {
                        console.error(`Error attempting to enable fullscreen: ${err.message}`);
                    });
                } else {
                    document.exitFullscreen();
                }
            }
        }

        // Initialize first project on page load
        document.addEventListener('DOMContentLoaded', async () => {
            console.log('Page loaded, initializing...');

            // Get first project button and simulate click after a short delay
            const firstProjectButton = document.querySelector('.tab-button.active');
            if (firstProjectButton) {
                const projectId = firstProjectButton.getAttribute('onclick').match(/selectProject\((\d+)/)[1];
                const projectName = firstProjectButton.querySelector('p').textContent.trim();

                setTimeout(async () => {
                    await selectProject(parseInt(projectId), firstProjectButton, projectName);
                }, 1000);
            }
        });

        // Cleanup connections when page unloads
        window.addEventListener('beforeunload', async () => {
            console.log('Cleaning up connections...');

            if (projectConnection) {
                await projectConnection.disconnect();
                projectConnection = null;
            }

            await disconnectAllGridCameras();

            currentProject = null;
            currentCameras = [];
        });

        // Expose global functions for debugging
        window.janusDebug = {
            currentProject,
            projectConnection,
            currentCameras,
            gridConnections,
            selectProject,
            switchCamera,
            toggleAllCamView,
            updateCameraControlData,
            getCurrentCameraId
        };
    </script>
    <script>
        class RecordingsPlayer {
            constructor() {
                this.video = document.getElementById('recordingVideo');
                this.isPlaying = false;
                this.currentDate = new Date();
                this.datePicker = null;
                this.timelinePosition = 0;
                this.pixelsPerSecond = 10; // Base pixels per second for timeline
                this.zoomLevel = 0; // Start at level 0
                this.recordingSegments = []; // Store recording segments (start/end in seconds from midnight)
                this.recordings = []; // Store all recordings data
                this.currentRecording = null; // Currently playing recording
                this.currentRecordingIndex = 0; // Index of current recording
                this.isUserDragging = false; // Track if user is manually dragging timeline
                this.isPlayingSegmentFromClick = false; // Track if playing segment from user click (prevents timeline re-render)

                // Zoom levels with time intervals in seconds
                // Level 0: 12 hours (43200 seconds) - shows 12am, 12pm, 12am
                // Level 1: 6 hours (21600 seconds) - shows 12am, 6am, 12pm, 6pm, 12am
                // Level 2: 2 hours (7200 seconds)
                // Level 3: 1 hour (3600 seconds)
                // Level 4: 30 minutes (1800 seconds)
                // Level 5: 20 minutes (1200 seconds)
                // Level 6: 15 minutes (900 seconds)
                // Level 7: 10 minutes (600 seconds)
                // Level 8: 5 minutes (300 seconds)
                // Level 9: 1 minute (60 seconds)
                this.zoomLevels = [43200, 21600, 7200, 3600, 1800, 1200, 900, 600, 300, 60];
                this.maxZoomLevel = this.zoomLevels.length - 1;

                this.init();
            }

            init() {
                this.setupVideo();
                this.setupDatePicker();
                this.setupControls();
                this.setupTimeline();
                this.startTimelineAnimation();
                this.setupResizeHandler();
            }

            setupResizeHandler() {
                // Re-render timeline on window resize to recalculate fitted width for zoom levels 0 and 1
                let resizeTimeout;
                window.addEventListener('resize', () => {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(() => {
                        if (this.zoomLevel === 0 || this.zoomLevel === 1) {
                            this.renderTimeline();
                            this.updateTimelinePosition();
                        }
                    }, 250); // Debounce resize events
                });
            }

            setupVideo() {
                if (this.video) {
                    // Wait for video metadata to load
                    this.video.addEventListener('loadedmetadata', () => {
                        console.log('Video duration:', this.video.duration);
                        // Re-render timeline with actual video duration
                        // Skip re-rendering if playing segment from click (to preserve transform)
                        if (!this.isPlayingSegmentFromClick) {
                            this.renderTimeline();
                        }
                    });

                    // Update timeline as video plays
                    this.video.addEventListener('timeupdate', () => {
                        this.updateTimelinePosition();
                    });

                    // Handle video ended - try to play next segment if available
                    this.video.addEventListener('ended', () => {
                        this.isPlaying = false;
                        this.updatePlayButton();

                        // Check if there's a next recording segment
                        if (this.currentRecordingIndex < this.recordings.length - 1) {
                            console.log('Current recording ended, loading next segment...');
                            this.currentRecordingIndex++;
                            this.loadRecordingVideo(this.recordings[this.currentRecordingIndex]);
                            // Auto-play the next segment
                            this.video.addEventListener('loadedmetadata', () => {
                                this.video.play().then(() => {
                                    this.isPlaying = true;
                                    this.updatePlayButton();
                                }).catch(err => {
                                    console.log('Autoplay prevented for next segment:', err);
                                });
                            }, { once: true });
                        }
                    });

                    // Handle play/pause events
                    this.video.addEventListener('play', () => {
                        this.isPlaying = true;
                        this.updatePlayButton();
                    });

                    this.video.addEventListener('pause', () => {
                        this.isPlaying = false;
                        this.updatePlayButton();
                    });
                }
            }

            setupDatePicker() {
                const dateInput = document.getElementById('datePickerInput');
                if (dateInput) {
                    this.datePicker = flatpickr(dateInput, {
                        dateFormat: "m/d/Y",
                        defaultDate: new Date(),
                        theme: "dark",
                        onChange: (selectedDates) => {
                            this.currentDate = selectedDates[0];
                            this.loadRecordingsForDate(this.currentDate);
                        }
                    });

                    // Set initial value
                    const month = (this.currentDate.getMonth() + 1).toString().padStart(2, '0');
                    const day = this.currentDate.getDate().toString().padStart(2, '0');
                    const year = this.currentDate.getFullYear();
                    dateInput.value = `${month}/${day}/${year}`;
                }
            }

            setupControls() {
                // Play/Pause button
                const playPauseBtn = document.getElementById('playPauseBtn');
                if (playPauseBtn) {
                    playPauseBtn.addEventListener('click', () => this.togglePlayPause());
                }

                // Previous/Next buttons
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                if (prevBtn) {
                    prevBtn.addEventListener('click', () => this.skipBackward());
                }
                if (nextBtn) {
                    nextBtn.addEventListener('click', () => this.skipForward());
                }

                // Speed controls
                const speedSelector = document.getElementById('speedSelector');
                const playbackSpeed = document.getElementById('playbackSpeed');
                if (speedSelector) {
                    speedSelector.addEventListener('change', (e) => this.setPlaybackSpeed(e.target.value));
                }
                if (playbackSpeed) {
                    playbackSpeed.addEventListener('change', (e) => this.setPlaybackSpeed(e.target.value));
                }

                // Zoom controls
                const zoomIn = document.getElementById('zoomIn');
                const zoomOut = document.getElementById('zoomOut');
                const zoomSlider = document.getElementById('zoomSlider');

                if (zoomIn) {
                    zoomIn.addEventListener('click', () => this.changeZoom(1));
                }
                if (zoomOut) {
                    zoomOut.addEventListener('click', () => this.changeZoom(-1));
                }
                if (zoomSlider) {
                    zoomSlider.max = this.maxZoomLevel;
                    zoomSlider.value = this.zoomLevel;
                    zoomSlider.addEventListener('input', (e) => {
                        this.zoomLevel = parseInt(e.target.value);
                        this.updateTimeline();
                    });
                }
            }

            setupTimeline() {
                this.renderTimeline();
                this.setupTimelineInteractions();
            }

            setupTimelineInteractions() {
                const timelineContainer = document.getElementById('timelineContainer');
                if (!timelineContainer) return;

                let isDragging = false;
                let startX = 0;
                let startTransform = 0;

                // Always update time display to show what's under the red line
                this.updateRedLineTime();

                // Click to seek - bring clicked time to center
                timelineContainer.addEventListener('click', (e) => {
                    if (!isDragging) {
                        this.seekToClickPosition(e);
                    }
                });

                // Drag to scroll timeline
                timelineContainer.addEventListener('mousedown', (e) => {
                    // Disable dragging for zoom levels 0 and 1 (timeline fits container)
                    if (this.zoomLevel === 0 || this.zoomLevel === 1) {
                        return;
                    }

                    isDragging = false;
                    startX = e.clientX;
                    this.isUserDragging = true; // Set flag to prevent auto-positioning

                    const timelineContent = document.getElementById('timelineContent');
                    if (timelineContent) {
                        const currentTransform = timelineContent.style.transform;
                        startTransform = parseFloat(currentTransform.replace(/translateX\((-?\d+\.?\d*)px\)/, '$1')) || 0;
                    }

                    timelineContainer.style.cursor = 'grabbing';
                    e.preventDefault();
                });

                document.addEventListener('mousemove', (e) => {
                    if (e.buttons === 1 && startX !== 0) {
                        isDragging = true;
                        const deltaX = e.clientX - startX;
                        const timelineContent = document.getElementById('timelineContent');

                        if (timelineContent) {
                            const newTransform = startTransform + deltaX;

                            // Limit dragging to content bounds
                            const containerWidth = timelineContainer.offsetWidth;
                            const contentWidth = timelineContent.offsetWidth;
                            const maxTransform = 0;
                            const minTransform = -(contentWidth - containerWidth);

                            const clampedTransform = Math.max(minTransform, Math.min(maxTransform, newTransform));
                            timelineContent.style.transform = `translateX(${clampedTransform}px)`;

                            // Update time display to show what's under the red line
                            this.updateRedLineTime();
                        }
                    }
                });

                document.addEventListener('mouseup', () => {
                    if (startX !== 0) {
                        startX = 0;
                        timelineContainer.style.cursor = 'grab';

                        // If we were dragging, sync video to the red line position
                        if (isDragging) {
                            this.syncVideoToRedLine();
                        }

                        // Small delay to distinguish between click and drag
                        setTimeout(() => {
                            isDragging = false;
                            this.isUserDragging = false; // Re-enable auto-positioning
                        }, 100);
                    }
                });

                // Touch events for mobile
                let touchStartX = 0;
                let touchStartTransform = 0;

                timelineContainer.addEventListener('touchstart', (e) => {
                    touchStartX = e.touches[0].clientX;

                    const timelineContent = document.getElementById('timelineContent');
                    if (timelineContent) {
                        const currentTransform = timelineContent.style.transform;
                        touchStartTransform = parseFloat(currentTransform.replace(/translateX\((-?\d+\.?\d*)px\)/, '$1')) || 0;
                    }
                });

                timelineContainer.addEventListener('touchmove', (e) => {
                    e.preventDefault();
                    const deltaX = e.touches[0].clientX - touchStartX;
                    const timelineContent = document.getElementById('timelineContent');

                    if (timelineContent) {
                        const newTransform = touchStartTransform + deltaX;
                        const containerWidth = timelineContainer.offsetWidth;
                        const contentWidth = timelineContent.offsetWidth;
                        const maxTransform = 0;
                        const minTransform = -(contentWidth - containerWidth);

                        const clampedTransform = Math.max(minTransform, Math.min(maxTransform, newTransform));
                        timelineContent.style.transform = `translateX(${clampedTransform}px)`;

                        // Update red line time display
                        this.updateRedLineTime();
                    }
                });

                timelineContainer.addEventListener('touchend', () => {
                    // Sync video to red line position when touch ends
                    this.syncVideoToRedLine();
                });
            }

            seekToClickPosition(e) {
                const timelineContainer = document.getElementById('timelineContainer');
                const timelineContent = document.getElementById('timelineContent');

                if (!timelineContainer || !timelineContent) return;

                const rect = timelineContainer.getBoundingClientRect();
                const clickX = e.clientX - rect.left;

                // Get current transform
                const currentTransform = timelineContent.style.transform;
                const currentTranslateX = parseFloat(currentTransform.replace(/translateX\((-?\d+\.?\d*)px\)/, '$1')) || 0;

                // Calculate the clicked position on the timeline
                const clickedPosition = clickX - currentTranslateX;

                // Calculate time of day at clicked position (seconds from midnight) using same calculation as renderTimeline
                const containerWidth = timelineContainer.offsetWidth;
                const pixelsPerSecond = this.calculatePixelsPerSecond(containerWidth);
                const clickedSecondsFromMidnight = clickedPosition / pixelsPerSecond;

                // Find which recording segment this time falls into
                let targetRecording = null;
                let targetRecordingIndex = -1;
                let videoSeekTime = 0;

                for (let i = 0; i < this.recordingSegments.length; i++) {
                    const segment = this.recordingSegments[i];
                    if (clickedSecondsFromMidnight >= segment.startTime && clickedSecondsFromMidnight <= segment.endTime) {
                        targetRecording = this.recordings[i];
                        targetRecordingIndex = i;
                        // Calculate the seek time within this recording
                        videoSeekTime = clickedSecondsFromMidnight - segment.startTime;
                        break;
                    }
                }

                if (targetRecording) {
                    // Load the recording if it's not already loaded
                    if (this.currentRecordingIndex !== targetRecordingIndex) {
                        this.currentRecordingIndex = targetRecordingIndex;
                        this.loadRecordingVideo(targetRecording);
                        // Seek after video loads
                        this.video.addEventListener('loadedmetadata', () => {
                            this.video.currentTime = videoSeekTime;
                        }, { once: true });
                    } else {
                        // Same recording, just seek
                        this.video.currentTime = videoSeekTime;
                    }

                    // Move timeline to center on clicked position (only for scrollable zoom levels)
                    if (this.zoomLevel === 0 || this.zoomLevel === 1) {
                        // Timeline fits perfectly, no need to move it
                        timelineContent.style.transform = 'translateX(0px)';
                    } else {
                        // For higher zoom levels, center on clicked position
                        const containerWidth = timelineContainer.offsetWidth;
                        const centerX = containerWidth / 2;
                        const newTranslateX = centerX - clickedPosition;

                        // Apply bounds
                        const contentWidth = timelineContent.offsetWidth;
                        const maxTransform = 0;
                        const minTransform = -(contentWidth - containerWidth);
                        const clampedTransform = Math.max(minTransform, Math.min(maxTransform, newTranslateX));

                        // Move timeline
                        timelineContent.style.transform = `translateX(${clampedTransform}px)`;
                    }
                }
            }

            updateRedLineTime() {
                // Calculate what time is under the red line (center of timeline)
                const timelineContent = document.getElementById('timelineContent');
                const timelineContainer = document.getElementById('timelineContainer');

                if (!timelineContent || !timelineContainer) return;

                const containerWidth = timelineContainer.offsetWidth;
                const centerX = containerWidth / 2;

                // Get current transform
                const currentTransform = timelineContent.style.transform;
                const translateX = parseFloat(currentTransform.replace(/translateX\((-?\d+\.?\d*)px\)/, '$1')) || 0;

                // Calculate position on timeline that's at the center
                const positionAtCenter = -translateX + centerX;

                // Convert position to time of day (seconds from midnight) using same calculation as renderTimeline
                const pixelsPerSecond = this.calculatePixelsPerSecond(containerWidth);
                const secondsFromMidnight = positionAtCenter / pixelsPerSecond;

                // Find which recording this time falls into
                let videoTime = 0;
                for (let i = 0; i < this.recordingSegments.length; i++) {
                    const segment = this.recordingSegments[i];
                    if (secondsFromMidnight >= segment.startTime && secondsFromMidnight <= segment.endTime) {
                        videoTime = secondsFromMidnight - segment.startTime;
                        break;
                    }
                }

                // Update the time display
                if (this.video && videoTime >= 0) {
                    this.updateTimeDisplay(videoTime);
                }

                return { secondsFromMidnight, videoTime };
            }

            syncVideoToRedLine() {
                // Get the time that's under the red line
                const timeInfo = this.updateRedLineTime();
                if (!timeInfo) {
                    this.showVideoLoader();
                    return;
                }

                const { secondsFromMidnight, videoTime } = timeInfo;

                // Find which recording segment this time falls into
                let targetRecordingIndex = -1;
                for (let i = 0; i < this.recordingSegments.length; i++) {
                    const segment = this.recordingSegments[i];
                    if (secondsFromMidnight >= segment.startTime && secondsFromMidnight <= segment.endTime) {
                        targetRecordingIndex = i;
                        break;
                    }
                }

                // Store if video was playing before scroll
                const wasPlaying = this.isPlaying;

                if (targetRecordingIndex >= 0) {
                    // Hide loader since we found a video segment
                    this.hideVideoLoader();

                    // Load recording if different
                    if (this.currentRecordingIndex !== targetRecordingIndex) {
                        this.currentRecordingIndex = targetRecordingIndex;
                        this.loadRecordingVideo(this.recordings[targetRecordingIndex]);
                        // Seek after video loads
                        this.video.addEventListener('loadedmetadata', () => {
                            this.video.currentTime = videoTime;
                            // Resume playback if it was playing before
                            if (wasPlaying) {
                                this.video.play().catch(err => console.error('Play error:', err));
                            }
                        }, { once: true });
                    } else {
                        // Same recording, just seek
                        if (this.video && videoTime >= 0 && videoTime <= this.video.duration) {
                            this.video.currentTime = videoTime;
                            // Resume playback if it was playing before
                            if (wasPlaying && !this.isPlaying) {
                                this.video.play().catch(err => console.error('Play error:', err));
                            }
                        }
                    }
                } else {
                    // No video segment at this position - show loader
                    this.showVideoLoader();
                    // Pause video if playing
                    if (this.video && this.isPlaying) {
                        this.video.pause();
                        this.isPlaying = false;
                    }
                }
            }

            showVideoLoader() {
                const videoContainer = document.getElementById('videoContainer');
                if (videoContainer) {
                    let loader = videoContainer.querySelector('.video-loader');
                    if (!loader) {
                        loader = document.createElement('div');
                        loader.className = 'video-loader';
                        loader.innerHTML = '<div class="spinner"></div>';
                        videoContainer.appendChild(loader);
                    }
                    loader.style.display = 'flex';
                }
            }

            hideVideoLoader() {
                const videoContainer = document.getElementById('videoContainer');
                if (videoContainer) {
                    const loader = videoContainer.querySelector('.video-loader');
                    if (loader) {
                        loader.style.display = 'none';
                    }
                }
            }

            calculatePixelsPerSecond(containerWidth) {
                const totalSecondsInDay = 86400;

                if (this.zoomLevel === 0 || this.zoomLevel === 1) {
                    // Fit timeline to container width for 12-hour and 24-hour views
                    return containerWidth / totalSecondsInDay;
                } else {
                    // Use progressive zoom scaling for higher zoom levels
                    const basePixelsPerDay = 2400;
                    let zoomFactor;

                    if (this.zoomLevel <= 7) {
                        // Levels 2-7: Use moderate zoom (1.3x multiplier)
                        zoomFactor = Math.pow(1.3, this.zoomLevel - 1);
                    } else if (this.zoomLevel === 8) {
                        // Level 8 (5min): Use aggressive zoom for better spacing
                        const baseZoom = Math.pow(1.3, 6); // Zoom at level 7
                        zoomFactor = baseZoom * 2.5; // 2.5x multiplier for 5min level
                    } else {
                        // Level 9 (1min): Use very aggressive zoom for maximum spacing
                        const baseZoom = Math.pow(1.3, 6); // Zoom at level 7
                        zoomFactor = baseZoom * 2.5 * 3.5; // 2.5 * 3.5 = 8.75x multiplier for 1min level
                    }

                    return (basePixelsPerDay * zoomFactor) / totalSecondsInDay;
                }
            }

            renderTimeline() {
                const timelineScale = document.getElementById('timelineScale');
                const timelineRecordings = document.getElementById('timelineRecordings');

                if (!timelineScale) return;

                // Clear existing content
                timelineScale.innerHTML = '';

                // 24-hour timeline (86400 seconds in a day)
                const totalSecondsInDay = 86400; // 24 hours * 60 minutes * 60 seconds
                const startTime = 0; // Midnight
                const endTime = totalSecondsInDay;

                // Get current zoom interval
                const interval = this.zoomLevels[this.zoomLevel];

                // Calculate pixels per second based on zoom
                const timelineContainer = document.getElementById('timelineContainer');
                const containerWidth = timelineContainer ? timelineContainer.offsetWidth : 1200;

                const pixelsPerSecond = this.calculatePixelsPerSecond(containerWidth);
                const totalWidth = (this.zoomLevel === 0 || this.zoomLevel === 1) ? containerWidth : totalSecondsInDay * pixelsPerSecond;

                // Set timeline content width
                const timelineContent = document.getElementById('timelineContent');
                if (timelineContent) {
                    timelineContent.style.width = `${totalWidth}px`;
                }

                // Add horizontal baseline
                const baseline = document.createElement('div');
                baseline.className = 'timeline-baseline';
                baseline.style.width = `${totalWidth}px`;
                timelineScale.appendChild(baseline);

                // Generate time markers based on current zoom interval
                let labelIndex = 0;
                const labels = [];

                // First pass: collect all time markers
                for (let time = startTime; time <= endTime; time += interval) {
                    labels.push(time);
                }

                // Second pass: render markers with proper styling
                labels.forEach((time, index) => {
                    const position = time * pixelsPerSecond;

                    // Create vertical dotted line
                    const tick = document.createElement('div');
                    tick.className = 'timeline-tick dotted major';
                    tick.style.left = `${position}px`;
                    timelineScale.appendChild(tick);

                    // Create time label
                    const label = document.createElement('div');
                    label.className = 'timeline-label';

                    // Add special class for first and last labels to prevent cutoff
                    if (index === 0) {
                        label.classList.add('first');
                    } else if (index === labels.length - 1) {
                        label.classList.add('last');
                    }

                    label.style.left = `${position}px`;

                    // Format time as 12-hour format with AM/PM
                    const totalSeconds = Math.floor(time);
                    const hours24 = Math.floor(totalSeconds / 3600);
                    const minutes = Math.floor((totalSeconds % 3600) / 60);

                    // Convert to 12-hour format
                    const period = hours24 >= 12 ? 'PM' : 'AM';
                    const hours12 = hours24 === 0 ? 12 : hours24 > 12 ? hours24 - 12 : hours24;

                    // Format label based on interval
                    if (interval >= 3600) {
                        // For hour+ intervals, show just hour
                        label.textContent = `${hours12}:${minutes.toString().padStart(2, '0')} ${period}`;
                    } else {
                        // For sub-hour intervals, show hour:minute
                        label.textContent = `${hours12}:${minutes.toString().padStart(2, '0')} ${period}`;
                    }

                    timelineScale.appendChild(label);
                });

                // Add recording segments if any
                if (timelineRecordings) {
                    timelineRecordings.innerHTML = '';
                    timelineRecordings.style.width = `${totalWidth}px`;

                    console.log('Rendering timeline with segments:', this.recordingSegments);

                    // Check if we have actual recording data
                    if (this.recordingSegments && this.recordingSegments.length > 0) {
                        console.log(`Rendering ${this.recordingSegments.length} recording segments`);

                        // Add actual recording segments (grey bars showing when recordings exist)
                        this.recordingSegments.forEach((segment, index) => {
                            const segmentDiv = document.createElement('div');
                            segmentDiv.className = 'timeline-recording';
                            segmentDiv.dataset.recordingIndex = index;

                            // Calculate position based on time of day (seconds from midnight)
                            const segmentStartPos = segment.startTime * pixelsPerSecond;
                            const segmentWidth = (segment.endTime - segment.startTime) * pixelsPerSecond;

                            console.log(`Segment ${index}:`, {
                                startTime: segment.startTime,
                                endTime: segment.endTime,
                                startPos: segmentStartPos,
                                width: segmentWidth,
                                pixelsPerSecond: pixelsPerSecond
                            });

                            segmentDiv.style.left = `${segmentStartPos}px`;
                            segmentDiv.style.width = `${segmentWidth}px`;
                            segmentDiv.style.backgroundColor = '#606670'; // Ensure color is set

                            // Add click handler to play from clicked position
                            segmentDiv.style.cursor = 'pointer';
                            segmentDiv.addEventListener('click', (e) => {
                                e.stopPropagation(); // Prevent timeline click event

                                // Calculate the time position that was clicked
                                const rect = segmentDiv.getBoundingClientRect();
                                const clickX = e.clientX - rect.left;
                                const segmentWidth = rect.width;
                                const segment = this.recordingSegments[index];
                                const segmentDuration = segment.endTime - segment.startTime;

                                // Calculate video time based on click position within segment
                                const clickRatio = clickX / segmentWidth;
                                const videoTime = clickRatio * segmentDuration;

                                console.log('Clicked position:', { clickX, segmentWidth, clickRatio, videoTime });

                                // Play from clicked position
                                this.playSegmentAtTime(index, videoTime);
                            });

                            timelineRecordings.appendChild(segmentDiv);
                            console.log('Segment div added:', segmentDiv);
                        });
                    } else {
                        console.log('No recording segments to render');
                    }
                    // If no recordings, the timeline will show empty (no grey bars)
                }

                // Initialize timeline position
                this.updateTimelinePosition();
            }

            getTimeInterval() {
                // Return interval in seconds based on zoom level
                const baseInterval = 60; // 1 minute
                if (this.zoomLevel >= 8) return baseInterval / 4; // 15 seconds
                if (this.zoomLevel >= 6) return baseInterval / 2; // 30 seconds
                if (this.zoomLevel >= 4) return baseInterval; // 1 minute
                if (this.zoomLevel >= 2) return baseInterval * 2; // 2 minutes
                return baseInterval * 5; // 5 minutes
            }

            formatTimeLabel(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const period = hours >= 12 ? 'PM' : 'AM';
                const displayHours = hours === 0 ? 12 : hours > 12 ? hours - 12 : hours;
                return `${displayHours}:${minutes.toString().padStart(2, '0')} ${period}`;
            }

            updateTimelinePosition() {
                if (!this.video || !this.currentRecording) return;

                // Don't auto-position timeline if user is manually dragging
                if (this.isUserDragging) return;

                const videoCurrentTime = this.video.currentTime;

                // Calculate the actual time of day for current playback position
                // Start with recording's start_seconds (seconds from midnight) + video current time
                const currentSecondsFromMidnight = this.currentRecording.start_seconds + videoCurrentTime;

                // Calculate position on 24-hour timeline using same formula as renderTimeline
                const totalSecondsInDay = 86400;
                const timelineContainer = document.getElementById('timelineContainer');
                const timelineContent = document.getElementById('timelineContent');
                const containerWidth = timelineContainer ? timelineContainer.offsetWidth : 1200;

                const pixelsPerSecond = this.calculatePixelsPerSecond(containerWidth);
                const position = currentSecondsFromMidnight * pixelsPerSecond;

                // Move timeline so current time is at center
                if (timelineContent && timelineContainer) {
                    const centerOffset = containerWidth / 2;
                    const translateX = centerOffset - position;

                    // For zoom levels 0 and 1, don't translate if timeline fits in container
                    if (this.zoomLevel === 0 || this.zoomLevel === 1) {
                        // Timeline fits perfectly, no translation needed
                        timelineContent.style.transform = 'translateX(0px)';
                    } else {
                        // Ensure timeline doesn't scroll past bounds for higher zoom levels
                        const maxTranslate = 0;
                        const minTranslate = -(timelineContent.offsetWidth - containerWidth);
                        const clampedTranslate = Math.max(minTranslate, Math.min(maxTranslate, translateX));
                        timelineContent.style.transform = `translateX(${clampedTranslate}px)`;
                    }
                }

                // Update time display
                this.updateTimeDisplay(videoCurrentTime);
            }

            updateTimeDisplay(videoCurrentTime) {
                const cursorTime = document.getElementById('cursorTime');
                if (!cursorTime) return;

                // If video is playing and we have a recording, show recording timestamp
                if (this.isPlaying && this.currentRecording && this.currentRecording.recording_timestamp) {
                    // Parse the recording timestamp (format: 2025:10:09 13:58:04)
                    const timestampParts = this.currentRecording.recording_timestamp.split(/[: ]/);
                    const recordingStart = new Date(
                        parseInt(timestampParts[0]), // year
                        parseInt(timestampParts[1]) - 1, // month (0-indexed)
                        parseInt(timestampParts[2]), // day
                        parseInt(timestampParts[3]), // hour
                        parseInt(timestampParts[4]), // minute
                        parseInt(timestampParts[5])  // second
                    );

                    // Add the current video playback position to the recording start time
                    const currentTimestamp = new Date(recordingStart.getTime() + (videoCurrentTime * 1000));

                    // Format to 12-hour time with AM/PM
                    const hours24 = currentTimestamp.getHours();
                    const minutes = currentTimestamp.getMinutes();
                    const seconds = currentTimestamp.getSeconds();
                    const period = hours24 >= 12 ? 'PM' : 'AM';
                    const hours12 = hours24 === 0 ? 12 : hours24 > 12 ? hours24 - 12 : hours24;

                    cursorTime.textContent = `${hours12}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} ${period}`;
                } else {
                    // If not playing or no recording, show current system time
                    const now = new Date();
                    const hours24 = now.getHours();
                    const minutes = now.getMinutes();
                    const seconds = now.getSeconds();
                    const period = hours24 >= 12 ? 'PM' : 'AM';
                    const hours12 = hours24 === 0 ? 12 : hours24 > 12 ? hours24 - 12 : hours24;
                    cursorTime.textContent = `${hours12}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} ${period}`;
                }
            }

            initializeCursorTime() {
                // Set cursor time to current actual time when loading recording
                const cursorTime = document.getElementById('cursorTime');
                if (cursorTime) {
                    const now = new Date();
                    const hours24 = now.getHours();
                    const minutes = now.getMinutes();
                    const seconds = now.getSeconds();
                    const period = hours24 >= 12 ? 'PM' : 'AM';
                    const hours12 = hours24 === 0 ? 12 : hours24 > 12 ? hours24 - 12 : hours24;
                    cursorTime.textContent = `${hours12}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} ${period}`;
                }
            }

            startTimelineAnimation() {
                // Continuously update timeline position when playing
                const animate = () => {
                    if (this.isPlaying && this.video) {
                        this.updateTimelinePosition();
                    }
                    requestAnimationFrame(animate);
                };
                animate();
            }

            formatTime(seconds) {
                const hours = Math.floor(seconds / 3600);
                const minutes = Math.floor((seconds % 3600) / 60);
                const secs = Math.floor(seconds % 60);
                const period = hours >= 12 ? 'PM' : 'AM';
                const displayHours = hours === 0 ? 12 : hours > 12 ? hours - 12 : hours;
                return `${displayHours}:${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')} ${period}`;
            }

            getSegmentAtRedLine() {
                // Calculate what time is under the red line (center of timeline)
                const timelineContent = document.getElementById('timelineContent');
                const timelineContainer = document.getElementById('timelineContainer');

                if (!timelineContent || !timelineContainer) return null;

                const containerWidth = timelineContainer.offsetWidth;
                const centerX = containerWidth / 2;

                // Get current transform
                const currentTransform = timelineContent.style.transform;
                const translateX = parseFloat(currentTransform.replace(/translateX\((-?\d+\.?\d*)px\)/, '$1')) || 0;

                // Calculate position on timeline that's at the center
                const positionAtCenter = -translateX + centerX;

                // Convert position to time of day (seconds from midnight) using same calculation as renderTimeline
                const pixelsPerSecond = this.calculatePixelsPerSecond(containerWidth);
                const secondsFromMidnight = positionAtCenter / pixelsPerSecond;

                // Find which recording segment this time falls into
                for (let i = 0; i < this.recordingSegments.length; i++) {
                    const segment = this.recordingSegments[i];
                    if (secondsFromMidnight >= segment.startTime && secondsFromMidnight <= segment.endTime) {
                        const videoTime = secondsFromMidnight - segment.startTime;
                        return {
                            segmentIndex: i,
                            recording: this.recordings[i],
                            secondsFromMidnight: secondsFromMidnight,
                            videoTime: videoTime
                        };
                    }
                }

                return null;
            }

            togglePlayPause() {
                if (!this.video) return;

                if (this.isPlaying) {
                    // Pause the video
                    this.video.pause();
                    this.isPlaying = false;
                    this.updatePlayButton();
                } else {
                    // Play - but first check if we need to load a different recording
                    const segmentAtRedLine = this.getSegmentAtRedLine();

                    if (segmentAtRedLine) {
                        // Check if we need to switch recordings
                        if (this.currentRecordingIndex !== segmentAtRedLine.segmentIndex) {
                            console.log(`Switching to recording ${segmentAtRedLine.segmentIndex} at time ${segmentAtRedLine.videoTime}s`);

                            // Load the correct recording
                            this.currentRecordingIndex = segmentAtRedLine.segmentIndex;
                            this.loadRecordingVideo(segmentAtRedLine.recording);

                            // Seek to the correct position after metadata loads
                            this.video.addEventListener('loadedmetadata', () => {
                                this.video.currentTime = segmentAtRedLine.videoTime;
                                this.video.play().then(() => {
                                    this.isPlaying = true;
                                    this.updatePlayButton();
                                }).catch(err => {
                                    console.error('Autoplay prevented:', err);
                                    this.isPlaying = false;
                                    this.updatePlayButton();
                                });
                            }, { once: true });
                        } else {
                            // Same recording, just seek and play
                            this.video.currentTime = segmentAtRedLine.videoTime;
                            this.video.play().then(() => {
                                this.isPlaying = true;
                                this.updatePlayButton();
                            }).catch(err => {
                                console.error('Autoplay prevented:', err);
                                this.isPlaying = false;
                                this.updatePlayButton();
                            });
                        }
                    } else {
                        // No segment at red line, just play current video
                        this.video.play().then(() => {
                            this.isPlaying = true;
                            this.updatePlayButton();
                        }).catch(err => {
                            console.error('Autoplay prevented:', err);
                            this.isPlaying = false;
                            this.updatePlayButton();
                        });
                    }
                }
            }

            updatePlayButton() {
                const playIcon = document.getElementById('playIcon');
                const pauseIcon = document.getElementById('pauseIcon');
                if (playIcon && pauseIcon) {
                    playIcon.style.display = this.isPlaying ? 'none' : 'block';
                    pauseIcon.style.display = this.isPlaying ? 'block' : 'none';
                }
            }

            skipBackward() {
                if (this.video) {
                    this.video.currentTime = Math.max(0, this.video.currentTime - 10);
                }
            }

            skipForward() {
                if (this.video) {
                    this.video.currentTime = Math.min(this.video.duration, this.video.currentTime + 10);
                }
            }

            setPlaybackSpeed(speed) {
                if (this.video) {
                    this.video.playbackRate = parseFloat(speed);
                }
            }

            changeZoom(direction) {
                const previousZoom = this.zoomLevel;

                // Update zoom level with bounds checking
                if (direction > 0) {
                    // Zoom in (increase detail)
                    this.zoomLevel = Math.min(this.maxZoomLevel, this.zoomLevel + 1);
                } else {
                    // Zoom out (decrease detail)
                    this.zoomLevel = Math.max(0, this.zoomLevel - 1);
                }

                console.log(`Zoom level changed from ${previousZoom} to ${this.zoomLevel}, interval: ${this.zoomLevels[this.zoomLevel]}s`);

                const zoomSlider = document.getElementById('zoomSlider');
                if (zoomSlider) {
                    zoomSlider.value = this.zoomLevel;
                    zoomSlider.max = this.maxZoomLevel;
                }

                // Re-render timeline with new zoom
                this.renderTimeline();

                // Maintain current position after zoom
                this.updateTimelinePosition();
            }

            updateTimeline() {
                // Re-render timeline with new zoom level
                this.renderTimeline();
                this.updateTimelinePosition();
            }

            playRecordingAtIndex(index) {
                if (index >= 0 && index < this.recordings.length) {
                    this.currentRecordingIndex = index;
                    this.loadRecordingVideo(this.recordings[index]);
                }
            }

            loadAllVideoDurations() {
                // Load video metadata for all recordings to get their durations
                this.recordings.forEach((recording, index) => {
                    const tempVideo = document.createElement('video');
                    tempVideo.src = recording.url;
                    tempVideo.preload = 'metadata';

                    tempVideo.addEventListener('loadedmetadata', () => {
                        const duration = Math.floor(tempVideo.duration);
                        console.log(`Recording ${index} duration: ${duration}s`);

                        // Update recording duration
                        this.recordings[index].duration = duration;

                        // Update segment end time
                        this.recordingSegments[index].duration = duration;
                        this.recordingSegments[index].endTime = this.recordingSegments[index].startTime + duration;

                        console.log(`Updated segment ${index}:`, this.recordingSegments[index]);

                        // Re-render timeline with updated segment
                        this.renderTimeline();
                    });

                    tempVideo.addEventListener('error', (e) => {
                        console.error(`Failed to load metadata for recording ${index}:`, e);
                    });
                });
            }

            setDemoRecordingSegments() {
                // Set demo segments for testing the timeline visualization
                // This creates multiple recording segments throughout the video
                const duration = this.video.duration || 300;

                // Create 3-4 recording segments with gaps
                this.recordingSegments = [
                    { startTime: 10, endTime: 60 },      // First minute after 10 seconds
                    { startTime: 90, endTime: 150 },     // 1:30 to 2:30
                    { startTime: 180, endTime: 240 },    // 3:00 to 4:00
                    { startTime: 270, endTime: duration } // 4:30 to end
                ];

                this.renderTimeline();
            }


            async loadRecordingsForDate(date) {
                console.log('Loading recordings for', date);

                // Get current camera ID
                const currentCameraId = getCurrentCameraId();
                if (!currentCameraId) {
                    this.showNoRecordingMessage('Please select a camera first');
                    return;
                }

                // Format date as YYYY-MM-DD using local timezone
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                // Show loading state
                this.showLoadingState();

                // Use jQuery AJAX with Laravel route
                $.ajax({
                    url: "{{ route('streams.camera.recording', ':cameraId') }}".replace(':cameraId', currentCameraId),
                    method: 'GET',
                    data: { date: formattedDate },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        if (data.success && data.has_recording) {
                            // Store all recordings
                            this.recordings = data.recordings;
                            console.log(`Loaded ${data.total_recordings} recordings for ${data.date}`);
                            console.log('Recording segments:', this.recordings);

                            // Build recording segments for timeline
                            // Note: If duration is null, we'll update it when video metadata loads
                            this.recordingSegments = this.recordings.map(rec => ({
                                startTime: rec.start_seconds,
                                endTime: rec.end_seconds, // Will be updated when video loads
                                duration: rec.duration, // Store duration for reference
                                recording: rec
                            }));

                            console.log('Timeline segments (initial):', this.recordingSegments);
                            console.log('First recording details:', this.recordings[0]);

                            // Load all videos in background to get their durations
                            this.loadAllVideoDurations();

                            // Render timeline with segments
                            this.renderTimeline();

                            // Check if there's a recording at current time
                            this.checkRecordingAtCurrentTime();
                        } else {
                            // Clear segments and re-render timeline
                            this.recordings = [];
                            this.recordingSegments = [];
                            this.renderTimeline();
                            // Show no recording available message
                            this.showNoRecordingMessage(data.message || 'No recording available for this date');
                        }
                    },
                    error: (xhr, status, error) => {
                        console.error('AJAX Error:', error);
                        this.showNoRecordingMessage('Failed to load recording');
                    }
                });
            }

            playSegmentAtTime(index, videoTime = 0) {
                if (index < 0 || index >= this.recordings.length) return;

                const recording = this.recordings[index];
                const segment = this.recordingSegments[index];

                console.log('Playing segment at time:', { index, videoTime, segment });

                // Hide loader since we're loading a valid video segment
                this.hideVideoLoader();

                // Set flag to prevent timeline re-render on video metadata load
                this.isPlayingSegmentFromClick = true;

                // Load and play recording from specified time
                this.currentRecordingIndex = index;
                this.loadRecordingVideo(recording);

                // Start from specified time
                this.video.addEventListener('loadedmetadata', () => {
                    this.video.currentTime = videoTime;
                    this.video.play();
                    this.isPlaying = true;
                    // Reset flag after video starts playing
                    setTimeout(() => {
                        this.isPlayingSegmentFromClick = false;
                    }, 100);
                }, { once: true });
            }

            playSegmentFromStart(index) {
                // Helper function to play segment from the beginning
                this.playSegmentAtTime(index, 0);
            }

            checkRecordingAtCurrentTime() {
                // Get current time in seconds from midnight
                const now = new Date();
                const currentSecondsFromMidnight = now.getHours() * 3600 + now.getMinutes() * 60 + now.getSeconds();

                console.log('Current time (seconds from midnight):', currentSecondsFromMidnight);

                // Check if any recording exists at current time
                let recordingAtCurrentTime = null;
                let recordingIndex = -1;

                for (let i = 0; i < this.recordingSegments.length; i++) {
                    const segment = this.recordingSegments[i];
                    if (currentSecondsFromMidnight >= segment.startTime && currentSecondsFromMidnight <= segment.endTime) {
                        recordingAtCurrentTime = this.recordings[i];
                        recordingIndex = i;
                        break;
                    }
                }

                if (recordingAtCurrentTime) {
                    // Load and play recording at current time
                    console.log('Found recording at current time:', recordingAtCurrentTime);
                    this.currentRecordingIndex = recordingIndex;
                    this.loadRecordingVideo(recordingAtCurrentTime);

                    // Seek to the correct position within the recording
                    const segment = this.recordingSegments[recordingIndex];
                    const videoSeekTime = currentSecondsFromMidnight - segment.startTime;

                    this.video.addEventListener('loadedmetadata', () => {
                        this.video.currentTime = videoSeekTime;
                    }, { once: true });
                } else {
                    // No recording at current time - show message but keep segments visible
                    console.log('No recording at current time');
                    this.showNoRecordingMessage('The recording is not available.', false);
                }
            }

            loadRecordingVideo(recording) {
                const video = document.getElementById('recordingVideo');

                if (!video || !recording.url) {
                    console.error('Video element or recording URL not found');
                    return;
                }

                console.log('Loading video from:', recording.url);

                // Store current recording
                this.currentRecording = recording;

                // Initialize cursor time with current time
                this.initializeCursorTime();

                // Clear existing content
                video.innerHTML = '';

                // Set video source directly (works better with direct S3 URLs)
                video.src = recording.url;
                video.type = recording.format || 'video/mp4';

                // Set crossorigin for CORS support
                video.crossOrigin = 'anonymous';

                // Remove any existing event listeners
                video.onloadedmetadata = null;
                video.onerror = null;
                video.oncanplay = null;
                video.onloadstart = null;

                // Add event listeners for debugging
                video.onloadstart = () => {
                    console.log('Video load started');
                };

                video.onloadedmetadata = () => {
                    console.log('Video metadata loaded, duration:', video.duration);
                    // Update duration if available
                    if (video.duration) {
                        this.totalDuration = video.duration;
                        this.updateTimeDisplay();
                    }
                    // Hide any error messages
                    this.hideNoRecordingMessage();
                };

                video.oncanplay = () => {
                    console.log('Video can start playing');
                    // Update video info overlay with camera name
                    const infoOverlay = document.getElementById('videoInfoOverlay');
                    if (infoOverlay) {
                        infoOverlay.textContent = `Camera: ${recording.camera_id} - ${recording.created_at}`;
                    }
                };

                video.onerror = (e) => {
                    console.error('Video loading error:', e);
                    console.error('Video error code:', video.error?.code);
                    console.error('Video error message:', video.error?.message);

                    // Map error codes to user-friendly messages
                    let errorMsg = 'Failed to load video. ';
                    if (video.error) {
                        switch(video.error.code) {
                            case 1: // MEDIA_ERR_ABORTED
                                errorMsg += 'Video loading was aborted.';
                                break;
                            case 2: // MEDIA_ERR_NETWORK
                                errorMsg += 'Network error. Check CORS configuration on S3 bucket.';
                                break;
                            case 3: // MEDIA_ERR_DECODE
                                errorMsg += 'Video decoding error. The file may be corrupted.';
                                break;
                            case 4: // MEDIA_ERR_SRC_NOT_SUPPORTED
                                errorMsg += 'Video format not supported or CORS blocking access.';
                                break;
                            default:
                                errorMsg += 'Unknown error occurred.';
                        }
                    }

                    // Try alternative loading method
                    console.log('Attempting alternative loading method...');
                    this.tryAlternativeVideoLoad(recording, errorMsg);
                };

                // Load the video
                video.load();

                // Try to play after a short delay to ensure metadata is loaded
                setTimeout(() => {
                    video.play().catch(err => {
                        console.log('Autoplay prevented:', err);
                        // This is normal - user interaction may be required
                    });
                }, 500);
            }

            tryAlternativeVideoLoad(recording, previousError) {
                const video = document.getElementById('recordingVideo');

                if (!video) return;

                // Try without crossorigin attribute
                console.log('Trying without crossorigin attribute...');

                // Remove crossorigin attribute
                video.removeAttribute('crossorigin');

                // Clear and set src directly
                video.innerHTML = '';
                video.src = recording.url;
                video.type = recording.format || 'video/mp4';

                // Add error handler
                video.onerror = () => {
                    console.error('Alternative loading also failed');
                    // Show detailed error message with instructions
                    this.showNoRecordingMessage(
                        previousError + '\n\n' +
                        'Troubleshooting steps:\n' +
                        '1. Verify S3 bucket has public read access for recordings\n' +
                        '2. Check CORS configuration is applied (see S3_BUCKET_SETUP.md)\n' +
                        '3. Ensure video files have correct Content-Type (video/mp4)\n' +
                        '4. Test the URL directly in a new browser tab: ' + recording.url
                    );
                };

                video.onloadeddata = () => {
                    console.log('Alternative method: Video loaded successfully');
                    this.hideNoRecordingMessage();

                    // Update duration
                    if (video.duration) {
                        this.totalDuration = video.duration;
                        this.updateTimeDisplay();
                    }

                    // Update info overlay
                    const infoOverlay = document.getElementById('videoInfoOverlay');
                    if (infoOverlay) {
                        infoOverlay.textContent = `Camera: ${recording.camera_id} - ${recording.created_at}`;
                    }
                };

                // Attempt to load
                video.load();
            }

            showNoRecordingMessage(message, clearSegments = true) {
                const videoContainer = document.getElementById('videoContainer');
                const video = document.getElementById('recordingVideo');

                // Only clear segments if explicitly requested (for date with no recordings)
                if (clearSegments) {
                    this.recordingSegments = [];
                    this.renderTimeline(); // Re-render timeline to show empty state
                }

                // Hide video
                if (video) {
                    video.style.display = 'none';
                }

                // Remove existing message if any
                const existingMessage = videoContainer.querySelector('.no-recording-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                // Create and show message
                const messageDiv = document.createElement('div');
                messageDiv.className = 'no-recording-message';
                messageDiv.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    color: #fff;
                    font-size: 18px;
                    text-align: center;
                    padding: 20px;
                    background: rgba(0,0,0,0.7);
                    border-radius: 8px;
                `;
                messageDiv.textContent = message;
                videoContainer.appendChild(messageDiv);
            }

            hideNoRecordingMessage() {
                const videoContainer = document.getElementById('videoContainer');
                const video = document.getElementById('recordingVideo');
                const message = videoContainer.querySelector('.no-recording-message');

                if (message) {
                    message.remove();
                }

                if (video) {
                    video.style.display = 'block';
                }
            }

            showLoadingState() {
                const videoContainer = document.getElementById('videoContainer');

                // Remove existing loader if any
                const existingLoader = videoContainer.querySelector('.loading-spinner');
                if (existingLoader) {
                    existingLoader.remove();
                }

                // Create and show loader
                const loaderDiv = document.createElement('div');
                loaderDiv.className = 'loading-spinner';
                loaderDiv.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%);
                    width: 50px;
                    height: 50px;
                    border: 3px solid #f3f3f3;
                    border-top: 3px solid #3b82f6;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                `;
                videoContainer.appendChild(loaderDiv);

                // Add spinner animation if not exists
                if (!document.getElementById('spinner-style')) {
                    const style = document.createElement('style');
                    style.id = 'spinner-style';
                    style.textContent = `
                        @keyframes spin {
                            0% { transform: translate(-50%, -50%) rotate(0deg); }
                            100% { transform: translate(-50%, -50%) rotate(360deg); }
                        }
                    `;
                    document.head.appendChild(style);
                }

                // Remove loader after a moment
                setTimeout(() => {
                    const loader = videoContainer.querySelector('.loading-spinner');
                    if (loader) {
                        loader.remove();
                    }
                }, 500);
            }
        }

        // Initialize player when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            window.recordingsPlayer = new RecordingsPlayer();
        });
    </script>
    @endpush
