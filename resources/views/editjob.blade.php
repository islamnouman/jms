<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                                    <a href="{{ route("job.index") }}" >
                                        <div class="flex items-center justify-start mb-6">
                                            <button class="bg-gray-100 hover:bg-gray-300 text-black-800 font-bold py-1.5 px-4 rounded inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                                </svg>
                                                <span>Go To Jobs</span>
                                            </button>
                                        </div>
                                    </a>

                                    <form method="POST" action="{{ route('job.update',$job_with_id->id ) }}">
                                    @csrf
                                        <x-input  type="hidden" name="_method" value="put" />

                                    <!-- Jobs Title -->
                                        <div>
                                            <x-label for="title" :value="__('Title')" />

                                            <x-input id="title" class="block mt-1 w-full" type="text" name="j_title"  value="{{$job_with_id->j_title}}" required autofocus />
                                        </div>


                                        <!-- Jobs Description -->
                                        <div>
                                            <x-label for="description" :value="__('Description')" />

                                            <x-input id="description" class="block mt-1 w-full" type="text" name="j_description"  value="{{$job_with_id->j_description}}"  required />
                                        </div>


                                        <div class="flex items-center justify-end mt-4">
                                            <x-button class="ml-3">
                                                {{ __('Update Job') }}
                                            </x-button>
                                        </div>
                                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
