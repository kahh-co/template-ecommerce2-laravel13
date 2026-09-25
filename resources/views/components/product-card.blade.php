<div class="bg-white rounded-2xl border shadow-sm overflow-hidden flex flex-col h-full min-w-0 hover:shadow-md transition-shadow">
    <div class="aspect-square overflow-hidden bg-stone-100 shrink-0">
        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy" class="block w-full h-full object-cover object-center">
    </div>
    <div class="p-3 flex-1 flex flex-col min-w-0">
        <div class="text-[11px] font-bold text-orange-700 uppercase truncate">{{ $p->category->name ?? '-' }}</div>
        <div class="font-bold leading-snug line-clamp-2 min-h-[2.6em] text-[13px] sm:text-[15px] break-words">{{ $p->name }}</div>
        <div class="mt-1 font-extrabold text-[14px] sm:text-base">Rp{{ number_format($p->price, 0, ',', '.') }}</div>
        <div class="mt-0.5 text-[11px] sm:text-xs {{ $p->stock > 0 ? 'text-green-700' : 'text-red-600' }}">{{ $p->stock > 0 ? "Stok: $p->stock" : 'Habis' }}</div>
        <div class="mt-auto pt-3 flex flex-col gap-1.5">
            <a href="{{ route('products.show', $p->slug) }}" class="w-full text-center text-[12px] sm:text-sm px-2 py-2 rounded-xl border font-bold truncate">View Detail</a>
            <form action="{{ route('cart.store') }}" method="POST" class="w-full">@csrf<input type="hidden" name="product_id" value="{{ $p->id }}"><button class="w-full text-[12px] sm:text-sm px-2 py-2 rounded-xl bg-[#2B1B12] text-white font-bold truncate">Add to Cart</button></form>
        </div>
    </div>
</div>
