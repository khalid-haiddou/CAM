<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Http\Request;
use App\Models\Participate;
use Illuminate\Support\Facades\Mail;

class ParticipatesController extends Controller
{
    // Show the participation form
    public function index()
    {
        return view('participate');
    }

    // Store participant information
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participates,email',
            'phone' => 'required|string|max:15',
        ]);

        Participate::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('thanks');
    }

    // Redirect to Google OAuth
    public function redirectToGoogle()
    {
        $client = $this->googleClient();
        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    // Handle Google OAuth callback
    public function handleGoogleCallback(Request $request)
    {
        $client = $this->googleClient();
        $client->authenticate($request->get('code'));
        $token = $client->getAccessToken();

        session(['google_token' => $token]);

        return redirect()->route('thanks');
    }

    // Add event to Google Calendar
    public function addEventToGoogleCalendar()
    {
        // Retrieve the Google Client
        $client = $this->googleClient();

        // Check if the token is present in the session
        if (!session('google_token')) {
            return redirect()->route('google.redirect'); // Redirect to Google OAuth if token is missing
        }

        // Set the access token from the session
        $client->setAccessToken(session('google_token'));

        // Check if the token is expired
        if ($client->isAccessTokenExpired()) {
            // Attempt to refresh the token
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                session(['google_token' => $client->getAccessToken()]);
            } else {
                return redirect()->route('google.redirect'); // Redirect to Google OAuth to reauthorize
            }
        }

        // Initialize the Google Calendar service
        $calendarService = new Google_Service_Calendar($client);

        // Demo Event Information (replace this with dynamic data if needed)
        $event = new Google_Service_Calendar_Event([
            'summary' => 'Eventoo Workshop',  // Replace with dynamic data if needed
            'location' => '123 Main Street, Rabat, Morocco',  // Replace with dynamic data if needed
            'description' => 'Join us for an engaging workshop to learn about Eventoo\'s features and benefits!', // Replace with dynamic data if needed
            'start' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => '2024-12-01T10:00:00+00:00', // Replace with dynamic data if needed
                'timeZone' => 'Africa/Casablanca',
            ]),
            'end' => new Google_Service_Calendar_EventDateTime([
                'dateTime' => '2024-12-01T12:00:00+00:00', // Replace with dynamic data if needed
                'timeZone' => 'Africa/Casablanca',
            ]),
        ]);

        try {
            // Log the event object before inserting
            \Log::info('Google Calendar Event:', [
                'event_summary' => $event->getSummary(),
                'event_location' => $event->getLocation(),
                'event_description' => $event->getDescription(),
            ]);

            // Insert event into the primary calendar
            $eventResult = $calendarService->events->insert('primary', $event);

            // Log the result of the insert
            \Log::info('Google Calendar Event Inserted:', [
                'event_id' => $eventResult->getId(),
                'event_status' => $eventResult->getStatus(),
            ]);

            // Redirect to thank you page with success message
            return redirect()->route('thanks')->with('message', 'Event successfully added to your Google Calendar!');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error adding event to Google Calendar:', ['error' => $e->getMessage()]);

            // In case of an error, redirect with an error message
            return redirect()->route('thanks')->withErrors('Error adding event: ' . $e->getMessage());
        }
    }

    // Helper function to create a Google client
    private function googleClient()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('REDIRECT_URI'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        return $client;
    }

    public function dashboard()
    {
    $participants = Participate::all(); // Fetch all participants
    
    $totalParticipants = Participate::count(); // Count total participants
    $participants = Participate::all(); // Fetch all participants
    return view('dashboard', compact('participants', 'totalParticipants'));
    }
    public function edit($id)
    {
    $participant = Participate::findOrFail($id);
    return view('edit-participant', compact('participant'));
    }

    public function update(Request $request, $id)
    {
    $participant = Participate::findOrFail($id);

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:participates,email,' . $id,
        'phone' => 'required|string|max:15',
    ]);

    $participant->update($request->all());

    return redirect()->route('dashboard')->with('message', 'Participant updated successfully!');
    }

    public function destroy($id)
{
    $participant = Participate::findOrFail($id);
    $participant->delete();

    return redirect()->route('dashboard')->with('message', 'Participant deleted successfully!');
}
public function total()
{
    $totalParticipants = Participate::count(); // Count total participants
    $participants = Participate::all(); // Fetch all participants
    return view('dashboard', compact('participants', 'totalParticipants'));
}

public function sendReminder()
{
    $participants = \App\Models\Participate::all();

    foreach ($participants as $participant) {
        Mail::send('emails.reminder', ['participant' => $participant], function ($message) use ($participant) {
            $message->to($participant->email)
                    ->subject('Reminder: Upcoming Event');
        });
    }

    return redirect()->route('dashboard')->with('message', 'Reminder emails sent successfully!');
}


}
