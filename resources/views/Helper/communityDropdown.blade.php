<div class="form-group col-md-6">
    <label for="community_id">Community</label>
    <select class="form-control" name="community_id" id="community_id">
        <option value="">Select a Community</option>
        @if ($communities)
            @foreach ($communities as $item)
                <option value="{{ $item->id }}"
                    {{ old('community_id',$selected) == $item->id ? 'selected' : '' }}>{{ $item->community_name }}
                </option>
            @endforeach
        @endif
    </select>
    @error('community_id')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>