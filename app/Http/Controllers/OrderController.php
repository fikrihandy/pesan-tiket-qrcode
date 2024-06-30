<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\Image\PngImageBackEnd;


class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('not_logged_in');
        }

        // Retrieve data from request
        $gameId = $request->input('game_id');
        $ticketCategory = $request->input('ticket_category');
        $quantity = $request->input('purchase_quantity');

        // Validate input data
        $request->validate([
            'game_id' => 'required|integer|exists:games,id',
            'ticket_category' => 'required|string',
            'purchase_quantity' => 'required|integer|min:1|max:2',
        ]);

        // Get game and ticket details
        $game = Game::findOrFail($gameId);
        $ticket = Ticket::where('game_id', $gameId)->where('category', $ticketCategory)->firstOrFail();

        // Get the total tickets already purchased by the user for this game
        $userId = Auth::id();
        $totalTicketsPurchased = Order::where('user_id', $userId)
            ->where('game_id', $gameId)
            ->sum('quantity');

        if ($totalTicketsPurchased + $quantity > 2) {
            return view('orders.limit_exceeded'); // Show the limit exceeded message
        }

        return view('orders.checkout', [
            'user' => Auth::user(),
            'game' => $game,
            'ticket' => $ticket,
            'quantity' => $quantity
        ]);
    }


    public function finalizeCheckout(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'game_id' => 'required|exists:games,id',
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1|max:2',
        ]);

        // Create order
        $order = new Order();
        $order->user_id = $request->input('user_id');
        $order->game_id = $request->input('game_id');
        $order->ticket_id = $request->input('ticket_id');
        $order->quantity = $request->input('quantity');
        $order->payment_method = 'direct'; // Temporary until payment gateway is implemented
        $order->payment_status = 'completed'; // Temporary until payment gateway is implemented
        $order->quantity = $request->input('quantity');

        //generate temporary qr code
        $tempId = Str::uuid()->toString();
        $order->qr_code = $tempId . $order->user_id . $order->game_id . $order->ticket_id;;
        $order->save();

        $order->id = $order->fresh()->id; // Reload order with updated data
        $order->qr_code = $order->id . $order->user_id . $order->game_id . $order->ticket_id;
        $order->save();

        return view('orders.success');
    }

    public function myTickets()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->with('game', 'ticket')->get();

        return view('orders.my_tickets', compact('orders'));
    }

    public function ticketDetail($id)
    {
        $order = Order::findOrFail($id);

        if (Auth::id() !== $order->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Generate the QR code
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCode = $writer->writeString($order->qr_code);

        return view('orders.ticket_detail', [
            'order' => $order,
            'qrCode' => $qrCode,
        ]);
    }
}

