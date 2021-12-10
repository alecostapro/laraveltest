<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Customer</label>
            <select class="form-control" name="customer_id" id="customer_id">
                @forelse ($customers as $customer)

                <option value="{{ $customer->id }}" @if (old('customer_id') == $customer->id || $order->customer_id == $customer->id) selected="selected" @endif>{{ $customer->fullName() }}</option>
                @empty
                <option value="" disabled>No customers yet</option>
                @endforelse
            </select>
            @error('customer_id')
            <p>{{ $message }}</p>
            @enderror
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $order->title) }}" required>
            @error('title')
            <p>{{ $message }}</p>
            @enderror
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ old('description', $order->description) }}" required>
            @error('description')
            <p>{{ $message }}</p>
            @enderror
            <label>Cost</label>
            <input type="number" name="cost" step="0.01" class="form-control" value="{{ old('cost', $order->cost) }}" required>
            @error('cost')
            <p>{{ $message }}</p>
            @enderror
            <label>Tags</label>
            <select class="form-control" name="tags[]" id="tag" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" @if (old('tag_id') == $tag->id || in_array($tag->id, $order->tagList())) selected="selected" @endif>{{ $tag->name }}</option>
                    @endforeach
            </select>
            @error('tags')
            <p>{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>



