<!-- Modal -->
<div id="plansModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="plansModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">{{ $trainee->name.' '.$trainee->surname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Select a plan to assign to trainee:
                <br /><br />
                <select name="planlist" id="planlist">
                    <option value="#">No plan.</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="submit" id="planSelect" class="btn btn-primary" href="/trainees/assign/{{ $trainee->id }}/{{ $plan->id }}" disabled>Assign</a>
            </div>
        </div>
    </div>
</div>