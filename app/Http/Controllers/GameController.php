<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    // Show games & game detail

    public function index()
    {
        $games = Game::orderBy('match_time', 'asc')->get();
        return view('home', compact('games'));
    }

    public function show($id)
    {
        $game = Game::findOrFail($id);
        $tickets = Ticket::where('game_id', $id)->get();

        $purchasedQuantities = DB::table('orders')
            ->join('tickets', 'orders.ticket_id', '=', 'tickets.id')
            ->select('tickets.category', DB::raw('SUM(orders.quantity) as total_purchased'))
            ->where('tickets.game_id', $id)
            ->groupBy('tickets.category')
            ->pluck('total_purchased', 'category');

        return view('game_detail', [
            'game' => $game,
            'tickets' => $tickets,
            'purchasedQuantities' => $purchasedQuantities
        ]);
    }


    //Create game & ticket

    public function create()
    {
        return view('admin.add_game_and_ticket');
    }

    public function store(Request $request)
    {

        $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'match_time' => 'required|date',
            'is_home_game' => 'required|boolean',
            'tournament_name' => 'required|string|max:255',
            'purchase_duration' => 'required|date',
            'stadium_name' => 'required|string|max:255',
            'status' => 'required|string|max:20',
        ]);

        if ($request->is_home_game == 1) {
            $request->validate([
                'vip_ticket_quantity' => 'required|integer',
                'vip_ticket_price' => 'required|integer',
                'a_ticket_quantity' => 'required|integer',
                'a_ticket_price' => 'required|integer',
                'b_ticket_quantity' => 'required|integer',
                'b_ticket_price' => 'required|integer',
                'guest_supporter_ticket_quantity' => 'required|integer',
                'guest_supporter_ticket_price' => 'required|integer',
            ]);
        }

        // Create game
        $game = new Game;
        $game->home_team = $request->home_team;
        $game->away_team = $request->away_team;
        $game->match_time = $request->match_time;
        $game->is_home_game = $request->is_home_game;
        $game->tournament_name = $request->tournament_name;
        $game->purchase_duration = $request->purchase_duration;
        $game->stadium_name = $request->stadium_name;
        $game->status = $request->status;
        $game->save();

        if ($request->is_home_game == 1) {
            // Create tickets
            $tickets = [
                ['category' => 'VIP', 'quantity' => $request->vip_ticket_quantity, 'price' => $request->vip_ticket_price],
                ['category' => 'A', 'quantity' => $request->a_ticket_quantity, 'price' => $request->a_ticket_price],
                ['category' => 'B', 'quantity' => $request->b_ticket_quantity, 'price' => $request->b_ticket_price],
                ['category' => 'Guest Supporter', 'quantity' => $request->guest_supporter_ticket_quantity, 'price' => $request->guest_supporter_ticket_price],
            ];

            foreach ($tickets as $ticketData) {
                $ticket = new Ticket;
                $ticket->game_id = $game->id;
                $ticket->category = $ticketData['category'];
                $ticket->quantity = $ticketData['quantity'];
                $ticket->price = $ticketData['price'];
                $ticket->save();
            }
        }

        return redirect()->route('admin.dashboard')->with('success', 'Game and tickets added successfully');
    }

}
