<!-- Sidebar backdrop -->
<div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
    style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>
<!-- Sidebar -->
<aside x-transition:enter="transition transform duration-300"
    x-transition:enter-start="-translate-x-full opacity-30  ease-in"
    x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0 opacity-100 ease-out"
    x-transition:leave-end="-translate-x-full opacity-0 ease-in"
    class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-r shadow-lg lg:z-auto lg:static lg:shadow-none"
    :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}">
    <!-- sidebar header -->
    <div class="flex items-center justify-between flex-shrink-0 p-2" :class="{'lg:justify-center': !isSidebarOpen}">
        <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
            C<span :class="{'lg:hidden': !isSidebarOpen}">-OOLER</span>
        </span>
        <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
            <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Sidebar links -->
    <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
        <ul class="p-2 overflow-hidden">
            <li title="Home">
                <a href="{{ route('home') }}"
                    class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                    :class="{'justify-center': !isSidebarOpen}">
                    <span>
                        <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Home</span>
                </a>
            </li>
            <li title="Dashboard">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                    :class="{'justify-center': !isSidebarOpen}">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                          </svg>

                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                </a>
            </li>
            <li title="Entries" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100
                    {{ (route('admin.student.index') == substr(url()->current(), 0, strlen(route('admin.student.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('admin.subject.index') == substr(url()->current(), 0, strlen(route('admin.subject.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('admin.schoolyear.index') == substr(url()->current(), 0, strlen(route('admin.schoolyear.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('admin.course.index') == substr(url()->current(), 0, strlen(route('admin.course.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('admin.enrollment.index') == substr(url()->current(), 0, strlen(route('admin.enrollment.index')) )) ? 'bg-gray-100' : '' }}
                    {{ (route('admin.program.index') == substr(url()->current(), 0, strlen(route('admin.program.index')) )) ? 'bg-gray-100' : '' }}
                " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Entries</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('student-show')
                    <li title="Student">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.student.index') == substr(url()->current(), 0, strlen(route('admin.student.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.student.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Student</span>
                        </a>
                    </li>
                    @endcan
                    @can('subject-show')
                    <li title="Subject">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.subject.index') == substr(url()->current(), 0, strlen(route('admin.subject.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.subject.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Subject</span>
                        </a>
                    </li>
                    @endcan
                    @can('school-year-show')
                    <li title="School Year">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.schoolyear.index') == substr(url()->current(), 0, strlen(route('admin.schoolyear.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.schoolyear.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">School Year</span>
                        </a>
                    </li>
                    @endcan
                    @can('course-show')
                    <li title="Course">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.course.index') == substr(url()->current(), 0, strlen(route('admin.course.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.course.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Course</span>
                        </a>
                    </li>
                    @endcan
                    @can('program-show')
                    <li title="Program">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.program.index') == substr(url()->current(), 0, strlen(route('admin.program.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.program.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Program</span>
                        </a>
                    </li>
                    @endcan
                    @can('enrollment-show')
                    <li title="Enrollment">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100
                        {{ (route('admin.enrollment.index') == substr(url()->current(), 0, strlen(route('admin.enrollment.index')) )) ? 'bg-gray-100' : '' }}
                        " :class="{'justify-center': !isSidebarOpen}"
                            href="{{ route('admin.enrollment.index') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                    <path fill-rule="evenodd"
                                        d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Enrollment</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li title="Menu Parent" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 rounded-md cursor-pointer hover:bg-gray-100"
                    :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Menu link</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    <li title="Sub Link 1">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('admin.dashboard') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Sub Link 1</span>
                        </a>
                    </li>
                    <li title="Sub Link 2">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('admin.dashboard') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11 4a1 1 0 10-2 0v4a1 1 0 102 0V7zm-3 1a1 1 0 10-2 0v3a1 1 0 102 0V8zM8 9a1 1 0 00-2 0v2a1 1 0 102 0V9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Sub Link 2</span>
                        </a>
                    </li>
                    <li title="Sub Link 2">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('admin.dashboard') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Sub Link 2</span>
                        </a>
                    </li>
                    <li title="Sub Link 4">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}" href="{{ route('admin.dashboard') }}">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Sub Link 4</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li title="Security" x-data="{
                open: false,
                toggle() {
                    if (this.open) {
                        return this.close()
                    }

                    this.$refs.button.focus()

                    this.open = true
                },
                close(focusAfter) {
                    if (! this.open) return

                    this.open = false

                    focusAfter && focusAfter.focus()
                }
            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['dropdown-button']">

                <a class="relative flex items-center w-full p-2 space-x-2 cursor-pointer hover:bg-gray-100 mmmmmmmm " :class="{'justify-center': !isSidebarOpen}" x-ref="button" x-on:click="toggle()"
                    :aria-expanded="open" :aria-controls="$id('dropdown-button')">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <span :class="{ 'lg:hidden': !isSidebarOpen }">Security</span>
                    <span class="absolute right-2" :class="{ 'lg:hidden': !isSidebarOpen }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 transition-all"
                            :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
                <ul x-ref="panel" x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                    :id="$id('dropdown-button')" style="display: none;">
                    @can('user-show')
                    <li title="Users">
                        <a class="flex items-center p-2 space-x-2 text-sm border-t border-b hover:bg-gray-100"
                        href="#">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Users</span>
                        </a>
                    </li>
                    @endcan
                    @can('role-show')
                    <li title="Roles">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100" href="#">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Roles</span>
                        </a>
                    </li>
                    @endcan
                    @can('permission-show')
                    <li title="Permissions">
                        <a class="flex items-center p-2 space-x-2 text-sm border-b hover:bg-gray-100" href="#">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Permissions</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <!-- Sidebar Links... -->
        </ul>
    </nav>
    <!-- Sidebar footer -->
    <div class="flex-shrink-0 p-2 border-t max-h-14">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring">
            <span>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </span>
            <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
        </a>
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
    </div>
</aside>
