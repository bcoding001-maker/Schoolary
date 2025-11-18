@if ($errors->any())
    <div class="bg-red-50 p-4 rounded-lg mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Error icon -->
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    Terjadi beberapa kesalahan:
                </h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif 