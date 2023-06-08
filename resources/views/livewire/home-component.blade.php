<div class="w-full bg-orange-200">
    @section('title', 'Enrollment Application')
<!-- flash message Start -->
@if(Session::has('success'))
<div x-data="{ msg:'true'}">
    <template x-if="msg">
        <div class="w-full text-white bg-blue-500">
            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                <div class="flex">
                    <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                        </path>
                    </svg>

                    <p class="mx-3">{{ Session::get('success') }}</p>
                </div>

                <button @click="msg = '' "
                    class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
@endif
@if(Session::has('error'))
<div x-data="{ msg:'true'}">
    <template x-if="msg">
        <div class="w-full text-white bg-red-500">
            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                <div class="flex">
                    <svg viewBox="0 0 40 40" class="w-6 h-6 fill-current">
                        <path
                            d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z">
                        </path>
                    </svg>

                    <p class="mx-3">{{ Session::get('error') }}</p>
                </div>

                <button @click="msg = '' "
                    class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>
@endif
<!-- flash message End -->


    <div class="container mx-auto md:p-5">
        <h3 class="p-1 mt-10 text-3xl font-semibold capitalize md:p-0">School Year</h3>
        <h1 class="p-1 text-5xl font-bold tracking-tighter text-orange-500 capitalize md:p-0">{{ $sy->school_yr }}</h1>


        <div class="relative z-0 w-full pt-10 pb-10">
            <div class="w-full p-1 mt-10 md:p-0">
                @foreach($courses as $course)
                <div class="w-full mb-10 bg-gray-800 border rounded-lg shadow-lg">
                    <h1 class="p-10 text-5xl font-bold tracking-tighter text-gray-300 uppercase">{{ $course->course_name }} - {{ $course->gpa }}%</h1>
                <div class="grid gap-1 p-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">

                    @foreach($cps as $cp)
                        @if($course->id == $cp->course_id)
                    <div class="relative w-full p-1 border rounded-lg bg-gray-50 md:m-0 md:border-0">
                        <div class="p-2 mb-4 md:mb-6">
                            <h1
                                class="mt-2 mb-2 text-2xl font-semibold leading-none tracking-tighter text-gray-800 capitalize">
                                <a class="border-gray-800 hover:border-b-2" href="#">{{ $cp->subject->sub_code }}</a>
                            </h1>
                            <p class="mt-2 mb-2 leading-5 text-gray-600">{{ $cp->subject->sub_name }}</p>
                        </div>
                        <div class="absolute flex justify-center gap-1 text-center bottom-2 right-2">
                            @auth
                            <x-button-orange href="#"
                                wire:click.prevent="store({{ $cp->school_year_id }}, '{{ $cp->subject_id }}',{{ $cp->course_id }})"
                                wire:loading.attr="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-6 h-6">
                                    <path
                                        d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </x-button-orange>
                            @endAuth
                        </div>

                    </div>
                        @endif
                    @endforeach


                </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- <div class="w-full p-2 m-2 md:p-0"></div> -->

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


