@extends('user.layouts.app')

@section('content')
    <button class="btn btn-primary" id="toTheTopBtn">
        <i class="fas fa-chevron-up"></i>
    </button>
    <div class="d-flex flex-row align-items-center mb-2">
        <div class="font-weight-bolder">{{count($lvas) . ' ' . __('courses')}}</div>
        <div class="form-inline ml-auto">
            <span class="mr-1">{{__('Sort after')}}</span>
            <div class="d-flex flex-column align-items-center">
                <select class="custom-select-sm w-100" id="sortSelect" name="sortSelect">
                    <option selected value="created_at">{{__('Date')}}</option>
                    <option value="title">{{__('Title')}}</option>
                    <option value="slotCount">{{__('# Slots')}}</option>
                </select>
                <select class="custom-select-sm w-100" id="sortType" name="sortType">
                    <option selected value="asc">{{__('ascending')}}</option>
                    <option value="desc">{{__('descending')}}</option>
                </select>
            </div>
        </div>
    </div>
    <div id="lvaList">
        @include('user.lva.sortedIndex')
    </div>
    <script>
        $('#sortSelect').change(changeSorting);
        $('#sortType').change(changeSorting)

        function changeSorting() {
            const selected = $('#sortSelect option:selected').val();
            const sortType = $('#sortType option:selected').val();
            $.get({
                url: '{{route('lva.index')}}',
                data: {
                    sortType: sortType,
                    sortAttr: selected
                },
                success: function (data) {
                    const $htmlData = $(data);
                    $('#lvaList').hide().html($htmlData).fadeIn();
                },
                error: function (error) {
                    console.log('Something went wrong');
                }
            });
        }
    </script>
    <script src="{{ asset('js/scrollToTop.js') }}"></script>
@endsection
