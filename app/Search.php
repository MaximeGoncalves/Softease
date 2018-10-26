<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class Search
{

    public function query($query, $sort, $technician)
    {

        if ($technician == null):
            if ($sort == null):
                $tickets = Ticket::where('topic', 'like', "%$query%")->with(['user', 'society', 'technician', 'source'])->orderBy('created_at', 'desc')->get();
            else:
                $tickets = Ticket::where('topic', 'like', "%$query%")->with(['user', 'society', 'technician', 'source'])->where('state', $sort)->orderBy('created_at', 'desc')->get();
            endif;
        else:
            if ($sort == null):
                $tickets = Ticket::where('topic', 'like', "%$query%")->with(['user', 'society', 'technician', 'source'])->where('technician_id', $technician)->orderBy('created_at', 'desc')->get();
            else:
                $tickets = Ticket::where('topic', 'like', "%$query%")->with(['user', 'society', 'technician', 'source'])->where('technician_id', $technician)->where('state', $sort)->orderBy('created_at', 'desc')->get();
            endif;
        endif;

        $data = '';
        foreach ($tickets as $ticket) {
            $state = ($ticket->state == 1) ? '<span class="badges badge badge-success mb-2">Cloturé</span>' : '<span class="badge badges badge-info mb-2">En cours</span>';
            $importance = ($ticket->importance == 1) ? '<span class="badge badges badge-danger mb-2">Urgent</span>' : '';
            $appointment = ($ticket->appointment) ? '<span class="badges badge badge-warning mb-2">' . date('d/M H:i', strtotime($ticket->appointment)) . '</span>' : '';
            $technician = isset($ticket->technician->user->fullname) ? $ticket->technician->user->fullname : '';
            $action = $this->action($ticket);
            $data .=
                '<tr>
                <td>' . $ticket->topic . '</td>
                <td>' . $ticket->user->fullname . '</td>
                <td>' . $ticket->created_at->diffForHumans() . '</td>
                <td>' . $ticket->user->society->name . '</td>
                <td>' . $technician . '</td>
//                <td class="d-flex flex-column">' . $state . $importance . $appointment . '</td>
                <td><div class="btn-group btn-action d-flex justify-content-center">
                        <a href="'.route('ticket.show', [$ticket->id]).'">
                            <i class="text-center fa fa-eye" style="color:grey; font-size: 20px;"></i></a>'.$action.
                    '</div ></td >
                </tr > ';
        }

        return $data;
    }

    private function action($ticket){
        if (Auth::user()->hasRole('ROLE_ADMIN')){
            return '<form action="'.route("ticket.destroy", [$ticket->id]).'" method="delete">
                             <button type = "submit"
                                    style = "border: none; background: transparent; cursor: pointer;"
                                    class="d-inline"
                                    onclick = "return confirm(\'Etes vous sûr de vouloir supprimer le ticket ?\');" >
                                <i class="fa fa-trash ml-2" style = "color:red; font-size: 20px;" ></i >
                            </button >
                      </form > ';
        }
    }
}
