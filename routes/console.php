<?php

use Illuminate\Support\Facades\Schedule;
use AppHealer\Services\MonitorDispatcher;

Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(10);return true;})->everyTenSeconds();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(15);return true;})->everyFifteenSeconds();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(30);return true;})->everyThirtySeconds();

Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(60);return true;})->everyMinute();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(120);return true;})->everyTwoMinutes();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(300);return true;})->everyFiveMinutes();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(600);return true;})->everyTenMinutes();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(900);return true;})->everyFifteenMinutes();
Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(1800);return true;})->everyThirtyMinutes();

Schedule::call(function () {app()->make(MonitorDispatcher::class)->dispatchMonitors(3600);return true;})->hourly();
