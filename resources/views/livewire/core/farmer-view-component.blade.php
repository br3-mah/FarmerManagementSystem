<div class="bg-gray-50 min-h-screen py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with Profile Summary -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="px-6 py-8 border-b border-gray-100">
                <div class="flex items-center space-x-6">
                    <div class="bg-green-100 rounded-full p-4 flex items-center justify-center">
                        <img src="default-profile.png" alt="Profile Image" class="w-16 h-16 rounded-full">
                    </div>
                    <div class="flex-1">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $farmer->user->name }}</h1>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <span class="material-icons">home</span> {{ $farmer->farm_name }}
                        </div>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <span class="material-icons">email</span> {{ $farmer->user->email }}
                        </div>
                    </div>
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Edit
                    </button>
                </div>
            </div>

            <!-- Farm Information Card -->
            <div class="px-6 py-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Farm Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-green-500 text-white">
                            <span class="material-icons">area_chart</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">Farm Size</div>
                            <div class="text-sm text-gray-500">{{ $farmer->farm_size }} acres</div>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-green-500 text-white">
                            <span class="material-icons">location_on</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">Location</div>
                            <div class="text-sm text-gray-500">{{ $farmer->farm_address }}</div>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-green-500 text-white">
                            <span class="material-icons">nature_people</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">Farming Type</div>
                            <div class="text-sm text-gray-500">{{ $farmer->type_of_farming }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Financial Information Card -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Financial Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-md bg-blue-500 text-white">
                            <span class="material-icons">monetization_on</span>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray900">Mobile Money</div>
                            <div class="text-sm text-gray500">{{ $farmer->mobile_money_number }}</div>
                        </div>
                    </div>

                    <div class="flex items-center p=4 bg-gray=50 rounded-lg">
                        <diV clasS= "flex-shrink=0 h=10 w=10 flex items=center justify=center rounded-md bg=blue=500 text=white ">
                            <span clasS= "material-icons ">account_balance</span >
                        </diV >
                        <diV clasS= "ml=4 ">
                            <diV clasS= "text=sm font-medium text=gray900 ">Bank Details</diV >
                            <diV clasS= "text=sm text=gray500 ">{{ $farmer->bank_name }}</diV >
                            <diV clasS= "text=sm text=gray500 ">Acc: {{ $farmer->bank_account_number }}</diV >
                        </diV >
                    </diV >
                </diV >
            </diV >
        </diV >
    </diV >
</diV >
