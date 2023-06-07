<div>
    @section('title', 'Programs / Create')
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Programs <span class="text-base text-gray-400">/</span> <span
                class="text-2xl">Create</span></h1>
        <a href="{{ route('admin.program.index') }}"
            class="inline-flex items-center px-6 py-2 space-x-1 text-white bg-purple-600 rounded-md shadow hover:bg-opacity-95">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
            <span>Back</span>
        </a>
    </div>
    <div class="max-w-full md:bg-gray-300 md:p-4">

        <section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">

            <form wire:submit.prevent="store">

                <div class="mt-4">
                    <div>
                        <label for="school_year_id" class="text-gray-700 dark:text-gray-200">School Year</label>
                        <select id="school_year_id" name="school_year_id" autocomplete="school_year_id" wire:model.lazy="school_year_id" required
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm
                            @error('school_year_id') border-red-500 @enderror">
                            <option value="">Select School year</option>
                            @foreach($sys as $sy)
                            <option value="{{ $sy->id }}">{{ $sy->school_yr }}</option>
                            @endforeach
                            @error('school_year_id')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="course_id" class="text-gray-700 dark:text-gray-200">Course</label>
                        <select id="course_id" name="course_id" autocomplete="course_id" wire:model.lazy="course_id" required
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm
                            @error('course_id') border-red-500 @enderror">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }} - {{ $course->gpa }}%</option>
                            @endforeach
                            @error('course_id')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="subject_id" class="text-gray-700 dark:text-gray-200">Subject</label>
                        <select id="subject_id" name="subject_id" autocomplete="subject_id" wire:model.lazy="subject_id" required
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm
                            @error('subject_id') border-red-500 @enderror">
                            <option value="">Select Subject</option>
                            @foreach($subs as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->sub_code }} - {{ $sub->sub_name }}</option>
                            @endforeach
                            @error('subject_id')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <div>
                        <label for="active" class="text-gray-700 dark:text-gray-200">Status</label>
                        <select id="active" name="active" autocomplete="active" wire:model.lazy="active" required
                            class="block w-full px-4 py-2 mt-2 bg-white border border-gray-200 rounded-md shadow-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:outline-none focus:ring focus:border-blue-400 dark:focus:border-blue-300 sm:text-sm
                            @error('active') border-red-500 @enderror">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                            @error('active')<p class="text-xs italic text-red-500">{{ $message }}</p>@enderror
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>
        </section>
    </div>
    <div wire:loading.delay.long>
        <!-- Loading screen -->
        <div show="true"
            class="fixed inset-0 z-[200] flex items-center justify-center text-white bg-black bg-opacity-10 text-3xl">
            <!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL -->
            <svg width="60" height="60" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)" stroke-width="2">
                        <circle stroke-opacity=".5" cx="18" cy="18" r="18" />
                        <path d="M36 18c0-9.94-8.06-18-18-18">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                dur="1s" repeatCount="indefinite" />
                        </path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>
