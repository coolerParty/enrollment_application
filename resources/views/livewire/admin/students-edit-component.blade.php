<div class="w-full pb-10 bg-orange-200">
    @section('title', 'Profile' )
    <div
        class="bg-white flex flex-col items-start justify-between pb-6 mb-2 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-lg font-semibold whitespace-nowrap">Profile <span class="text-base text-gray-400">/</span> {{
            $name }} <span class="text-base text-gray-400">/</span> <span class="text-2xl">Edit</span></h1>
        <a href="{{ route('admin.student.index') }}"
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

    <!-- order section starts  -->
    <section class="container mx-auto" id="order">

        <form class="w-full mx-auto mt-10" wire:submit.prevent="update">
            <div
                class="grid w-full grid-cols-1 gap-0 m-2 mx-auto mt-5 bg-white rounded-md shadow-lg md:max-w-5xl md:grid-cols-2"
            >
                <div
                    class="grid items-center w-full h-full bg-gray-800 rounded-t-lg md:rounded-bl-lg md:rounded-tl-lg md:rounded-tr-none"
                >
                    @if ($newimage)
                    <img
                        class="w-3/4 p-5 mx-auto rounded-full"
                        src="{{ $newimage->temporaryUrl() }}"
                        alt=""
                        width="100%"
                    />
                    <!-- <x-link-danger
                        type="button"
                        wire:click="removeImage"
                        class="absolute block w-full cursor-pointer bottom-5"
                        >Remove Selected Image</x-link-danger
                    > -->
                    @elseif($profile_photo_path)
                    <img
                        class="w-3/4 p-5 mx-auto rounded-full"
                        src="{{
                            asset('storage/assets/user/profile-photo/large')
                        }}/{{ $profile_photo_path }}"
                        width="100%"
                        alt=""
                    />
                    @else
                    <img
                        class="w-3/4 p-5 mx-auto rounded-full"
                        src="{{
                            asset('storage/assets/user/profile-photo/large')
                        }}/default.png"
                        width="100%"
                        alt=""
                    />
                    @endif
                </div>
                <!-- Billing Address Start -->
                <div class="p-5">
                    <h1 class="mb-5 text-xl font-semibold text-orange-500">
                        User Profile Edit
                    </h1>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="gpa"
                            >
                                GPA
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('gpa') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="gpa"
                                type="number"
                                placeholder="0"
                                wire:model.lazy="gpa"
                                min="0"
                                step="any"
                            />
                            @error('gpa')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="w-full px-3 md:w-1/2">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="scholar"
                            >
                                Scholar
                            </label>
                            <select id="scholar" name="scholar" autocomplete="scholar" wire:model.lazy="scholar" required
                            class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('scholar') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white
                            ">
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                        </select>
                            @error('scholar')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="name"
                            >
                                Username
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('name') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="name"
                                type="text"
                                placeholder="name"
                                wire:model.lazy="name"
                            />
                            @error('name')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="w-full px-3 md:w-1/2">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="email"
                            >
                                email
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('email') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="email"
                                type="email"
                                placeholder="example@email.com"
                                wire:model.lazy="email"
                            />
                            @error('email')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="firstname"
                            >
                                First Name
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('firstname') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="firstname"
                                type="text"
                                placeholder="firstname"
                                wire:model.lazy="firstname"
                            />
                            @error('firstname')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="w-full px-3 md:w-1/2">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="lastname"
                            >
                                Last Name
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('firstname') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="lastname"
                                type="text"
                                placeholder="lastname"
                                wire:model.lazy="lastname"
                            />
                            @error('lastname')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="mobile"
                            >
                                mobile
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('mobile') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="mobile"
                                type="text"
                                placeholder="mobile"
                                wire:model.lazy="mobile"
                            />
                            @error('mobile')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="city"
                            >
                                city
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('city') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="city"
                                type="text"
                                placeholder="city"
                                wire:model.lazy="city"
                            />
                            @error('city')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>


                    <div class="flex flex-wrap mb-6 -mx-3">

                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="province"
                            >
                                province
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('province') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="province"
                                type="text"
                                placeholder="province"
                                wire:model.lazy="province"
                            />
                            @error('province')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="w-full px-3 mb-6 md:w-1/2 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="country"
                            >
                                country
                            </label>
                            <input
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('country') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                                id="country"
                                type="text"
                                placeholder="country"
                                wire:model.lazy="country"
                            />
                            @error('country')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap mb-6 -mx-3">
                        <div class="w-full px-3 mb-6 md:mb-0">
                            <label
                                class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase"
                                for="newimage"
                                >Image</label
                            >
                            <input
                                id="newimage"
                                type="file"
                                name="newimage"
                                wire:model="newimage"
                                autocomplete="newimage"
                                class="block w-full px-4 py-3 mb-3 leading-tight text-gray-700 bg-gray-200 border @error('newimage') border-red-500 @enderror rounded appearance-none focus:outline-none focus:bg-white"
                            />
                            @error('newimage')
                            <p class="text-xs italic text-red-500">
                                {{ $message }}
                            </p>
                            @enderror
                            <div
                                class="block w-full px-4 py-2 m-1 text-white bg-emerald-500"
                                wire:loading
                                wire:target="newimage"
                            >
                                Uploading...
                            </div>
                            @if ($newimage)
                            <x-link-danger
                                type="button"
                                wire:click="removeImage"
                                class="block w-full cursor-pointer"
                                >Remove Selected Image</x-link-danger
                            >
                            @endif
                        </div>
                    </div>

                    <x-button-success type="submit" value="submit" name="submit"
                        >Update</x-button-success
                    >
                    <x-link-success
                        href="{{ route('admin.student.index') }}"
                        name="submit"
                        >Cancel</x-link-success
                    >
                </div>

                <!-- Billing Address End -->
            </div>
        </form>
    </section>
    <!-- order section ends -->
</div>
