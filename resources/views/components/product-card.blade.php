<div class="bg-white rounded-3xl border shadow-sm overflow-hidden flex flex-col">
    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" class="w-full h-44 object-cover">
    <div class="p-4 flex-1 flex flex-col">
        <div class="text-[11px] font-bold text-orange-700 uppercase">{{ $p->category->name ?? '-' }}</div>
        <div class="font-bold leading-tight">{{ $p->name }}</div>
        <div class="mt-1 font-extrabold">Rp{{ number_format($p->price, 0, ',', '.') }}</div>
        <div class="mt-1 text-xs {{ $p->stock > 0 ? 'text-green-700' : 'text-red-600' }}">{{ $p->stock > 0 ? "Stok: $p->stock" : 'Habis' }}</div>
        <div class="mt-3 flex gap-2">
            <a href="{{ route('products.show', $p->slug) }}" class="flex-1 text-center text-sm px-3 py-2 rounded-full border font-bold">View Detail</a>
            <form action="{{ route('cart.store') }}" method="POST" class="flex-1">@csrf<input type="hidden" name="product_id" value="{{ $p->id }}"><button class="w-full text-sm px-3 py-2 rounded-full bg-[#2B1B12] text-white font-bold">Add to Cart</button></form>
        </div>
    </div>
</div>
