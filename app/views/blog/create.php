<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: /my-blog/sign-in');
    exit;
}

// Retrieve old input data if it exists
$old_input = $_SESSION['old_input'] ?? [];
unset($_SESSION['old_input']); // Clear the old input after retrieving it

// Retrieve errors if they exist
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']); // Clear the errors after retrieving them
?>

<div class="container mx-auto px-4 py-12">
    <h1 class="text-5xl font-extrabold text-center mb-8 relative">
        <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-teal-400">Craft Your Masterpiece</span>
        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-48 h-1 bg-gradient-to-r from-blue-500 to-teal-400"></div>
    </h1>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-6" role="alert">
            <p class="font-bold">Please correct the following errors:</p>
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/my-blog/blog/store" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-2xl shadow-2xl max-w-3xl mx-auto">
        <div class="mb-6">
            <label for="title" class="block text-gray-700 font-bold mb-2 text-xl">🖊️ Title</label>
            <input type="text" name="title" id="title" required
                   class="shadow-inner border-2 border-purple-200 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                   placeholder="Enter a captivating title"
                   value="<?php echo htmlspecialchars($old_input['title'] ?? ''); ?>">
        </div>

        <div class="mb-6">
            <label for="content" class="block text-gray-700 font-bold mb-2 text-xl">📝 Content</label>
            <textarea name="content" id="content"
                      class="shadow-inner border-2 border-purple-200 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                      rows="8" placeholder="Pour your thoughts here..."><?php echo htmlspecialchars($old_input['content'] ?? ''); ?></textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-bold mb-2 text-xl">🖼️ Image</label>
            <div class="flex items-center justify-center w-full">
                <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-purple-300 border-dashed rounded-lg cursor-pointer bg-purple-50 hover:bg-purple-100 transition">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-10 h-10 mb-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-purple-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                        <p class="text-xs text-purple-500">PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*" />
                </label>
            </div>
        </div>

        <div class="mb-6">
            <label for="category" class="block text-gray-700 font-bold mb-2 text-xl">📚 Category</label>
            <input type="text" name="category" id="category"
                   class="shadow-inner border-2 border-purple-200 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                   placeholder="e.g., Technology, Travel, Food"
                   value="<?php echo htmlspecialchars($old_input['category'] ?? ''); ?>">
        </div>

        <div class="mb-6">
            <label for="tags" class="block text-gray-700 font-bold mb-2 text-xl">🏷️ Tags</label>
            <input type="text" name="tags" id="tags"
                   class="shadow-inner border-2 border-purple-200 rounded-lg w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition"
                   placeholder="Enter tags, separated by commas"
                   value="<?php echo htmlspecialchars($old_input['tags'] ?? ''); ?>">
        </div>

        <div class="mb-6 flex items-center">
            <label for="is_published" class="flex items-center cursor-pointer">
                <div class="relative">
                    <input type="checkbox" id="is_published" name="is_published" class="sr-only"
                           <?php echo isset($old_input['is_published']) ? 'checked' : ''; ?>>
                    <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                    <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                </div>
                <div class="ml-3 text-gray-700 font-bold">Publish Now</div>
            </label>
        </div>

        <button type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-blue-700 focus:outline-none focus:shadow-outline transform hover:scale-105 transition-all duration-300">
            🚀 Launch Your Blog Post
        </button>
    </form>
</div>

<style>
    input:checked ~ .dot {
        transform: translateX(100%);
    }

    input:checked ~ .block {
        background-color: #4C1D95;
    }
</style>