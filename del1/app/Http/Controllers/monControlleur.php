<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\tp;
use App\Models\matiere;
use App\Models\Contact;
use App\Models\quiz;
use App\Models\reponseModel;
use App\Models\Note;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;

class monControlleur extends Controller
{
    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->active = 1;
        $user->save();

        return response()->json(['success' => 'Utilisateur activé avec succès.']);
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->active = 0;
        $user->save();

        return response()->json(['success' => 'Utilisateur désactivé avec succès.']);
    }
    public function deleteAccount(Request $request)
{
    $user = Auth::user();
    Auth::logout();
    $user->delete();

    return redirect('/')->with('success', 'Votre compte a été supprimé avec succès.');
}

    public function statsglobal()
{
    $nombreProfesseurs = User::where('role', 'professeur')->count();
    $quizzes = Quiz::all();

    $quizLePlusFait = $quizzes->sortByDesc('attempts')->first();
    $quizLeMoinsFait = $quizzes->sortBy('attempts')->first();

    $maxNote = Note::max('note');
    $minNote = Note::min('note');

    // Récupérer les statistiques pour le diagramme circulaire
    $notes = Note::all();
    $notesInferieuresOuEgalesA5 = $notes->where('note', '<=', 5)->count();
    $notesEntre5Et10 = $notes->where('note', '>', 5)->where('note', '<', 10)->count();
    $notesEgalesA10 = $notes->where('note', 10)->count();
    $notesEntre10Et15 = $notes->where('note', '>', 10)->where('note', '<=', 15)->count();
    $notesEntre15Et20 = $notes->where('note', '>', 15)->where('note', '<', 20)->count();
    $notesEgalesA20 = $notes->where('note', 20)->count();

    return view('Statistiques/statistiqueGlobal', compact(
        'nombreProfesseurs',
        'quizLePlusFait',
        'quizLeMoinsFait',
        'maxNote',
        'minNote',
        'notesInferieuresOuEgalesA5',
        'notesEntre5Et10',
        'notesEgalesA10',
        'notesEntre10Et15',
        'notesEntre15Et20',
        'notesEgalesA20'
    ));
}

    public function statistiquesProfesseur()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();

    // Nombre de quiz du professeur
    $nombreDeQuiz = Quiz::where('user', $user->id)->count();

    // Notes maximales et minimales sur les quiz
    $maxNote = Note::whereIn('quiz', Quiz::where('user', $user->id)->pluck('id'))->max('note');
    $minNote = Note::whereIn('quiz', Quiz::where('user', $user->id)->pluck('id'))->min('note');

    // Quiz le plus fait et le moins fait
    $quizLePlusFait = Quiz::where('user', $user->id)
        ->withCount('notes')
        ->orderBy('notes_count', 'desc')
        ->first();

    $quizLeMoinsFait = Quiz::where('user', $user->id)
        ->withCount('notes')
        ->orderBy('notes_count', 'asc')
        ->first();

    return view('Statistiques/statistiqueProfesseur', compact('nombreDeQuiz', 'maxNote', 'minNote', 'quizLePlusFait', 'quizLeMoinsFait'));
}
    public function submit(Request $request, $id)
    {
        $quiz = quiz::findOrFail($id);
        $questions = $quiz->question;
        $score = 0;
        foreach ($questions as $question) {
            $selectedReponseId = $request->input('question_' . $question->id);
            $selectedReponse = reponseModel::find($selectedReponseId);

            if ($selectedReponse && $selectedReponse->status == '1') {
                $score += 2;
            }
        }
        Note::create([
            'quiz' => $id,
            'note' => $score,
        ]);


        return redirect()->route('EspaceQuiz', $id)->with('success', 'Vos réponses ont été soumises avec succès. Vous avez obtenu ' . $score . ' points.');
    }
	public function accueil(){
        return view('welcome');
    }
    public function registrer(){
        return view('reg');
    }
    public function contacts(){
        return view('Contacts');
    }

    public function soumettreFormulaire(Request $request) {
        // Valider les données du formulaire
        $rules = [
            'type_contact' => 'required'
        ];

        if ($request->type_contact == 'demande') {
            $rules = array_merge($rules, [
                'nom' => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ]+(?:[ \'-][A-Za-zÀ-ÿ]+)*$/'],
                'prenom' => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ]+(?:[ \'-][A-Za-zÀ-ÿ]+)*$/'],
                'email' => 'required|email|max:255|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                'phone' => 'required|digits:9',
                'etablissement' => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ]+(?:[ \'-][A-Za-zÀ-ÿ]+)*$/'],
                'texte' => 'nullable|string'
            ]);
        } else {
            $rules = array_merge($rules, [
                'nom' => 'nullable|string|max:255',
                'prenom' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                'phone' => 'nullable|digits:9',
                'etablissement' => 'nullable|string|max:255|regex:/^[A-Za-zÀ-ÿ]+(?:[ \'-][A-Za-zÀ-ÿ]+)*$/',
                'texte' => 'required|string'
            ]);

            // Mettre les champs à null si le type de contact n'est pas une demande
            $request->merge([
                'nom' => null,
                'prenom' => null,
                'email' => null,
                'phone' => null,
                'etablissement' => null
            ]);
        }

        $messages = [
            'nom.regex' => 'Le nom ne doit contenir que des lettres et des espaces, et ne peut pas commencer par un espace.',
            'prenom.regex' => 'Le prénom ne doit contenir que des lettres et des espaces, et ne peut pas commencer par un espace.',
            'email.regex' => 'L\'email doit être une adresse @gmail.com valide.',
            'phone.digits' => 'Le numéro de téléphone doit contenir exactement 9 chiffres.',
            'etablissement.regex' => 'L\'établissement ne doit contenir que des lettres et des espaces, et ne peut pas commencer par un espace.',
        ];

        $validatedData = $request->validate($rules, $messages);

        // Enregistrez les données dans la table des contacts
        Contact::create($validatedData);

        return back()->with('success', 'Votre demande a été soumise avec succès.');
    }


    public function Espace_Professeur(){
        return view('A-propos');
    }
    public function IU_professeur(){
        return view('dashboardProfesseur');
    }
    public function IU_admin(){
        return view('dashboardAdmin');
    }
    public function addUser(){
        return view('les_utilisateurs/AjoutUser');
    }
    public function ListerUser(){
        $admins = User::where('role', 'admin')->get();
        $professeurs = User::where('role', 'professeur')->get();
        return view('les_utilisateurs/listerUser',compact('admins', 'professeurs'));
    }
    public function ListerQuiz(){
        $matieres = Matiere::with(['quizzes.professeur', 'quizzes.matiere'])->get();
        return view('les_quiz/Liste_quiz',compact('matieres'));
    }
    public function modUser($id){
        $user = User::find($id);
        return view('les_utilisateurs/modifierUser', compact('user'));
    }
    public function profil($id){
        $user = User::find($id);
        return view('profil', compact('user'));
    }
    public function ListerTP(){
        $matieres = matiere::with('tps')->get(); // Récupère toutes les matières avec leurs TPs associés
        return view('Les_tps/listerTp', compact('matieres'));
    }
    public function AddTP($id){
        return view('Les_tps/AjoutTp',compact('id'));
    }
    public function ModTP(){
        return view('modTp');
    }
    public function segDem(){
        $contSug = Contact::where('type_contact', 'suggestion')->get();
        $contDem = Contact::where('type_contact', 'demande')->get();
        return view('SugetDemande', compact('contSug','contDem'));
    }
    public function faireQuiz($id){
        $quiz = Quiz::with('question.reponse')->findOrFail($id);
        return view('EspaceQuiz', compact('quiz'));
    }
     public function Espace_Admin(){
        return view('EspaceConnexion');
    }
    public function chimie(){
        $tps = tp::where('matiere', 1)->get();
        $quizs = Quiz::with('professeur')
                  ->where('matiere', 1)
                  ->get();
        return view('EspaceChimie',compact('tps', 'quizs'));
    }
    public function svt(){
        $tps = tp::where('matiere', 2)->get();
        $quizs = Quiz::with('professeur')
        ->where('matiere', 2)
        ->get();
        return view('EspaceSvt',compact('tps', 'quizs'));
    }
    public function update(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->prenom = $request->input('prenom');
        $user->nom = $request->input('nom');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if ($user->role === 'professeur') {
            $user->Etablissement = $request->input('etablissement');
        } else {
            $user->Etablissement = null;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->back()->with(['success' => 'Utilisateur modifié avec succès.']);
    }

    public function InscrireU(Request $request)
    {
        \Log::info('Inscription utilisateur appelée');
        $request->validate([
            'Nom' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s\'-]+$/',
            'prenom' => 'required|string|max:255|regex:/^[a-zA-ZÀ-ÿ\s\'-]+$/',
            'phone' => 'required|digits:9',
            'Email' => 'required|string|email|max:255|unique:users,email',
            'MDP' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,professeur',
            'Etablissement' => 'required_if:role,professeur|string|max:255|nullable',
        ], [
            'Nom.required' => 'Le champ Nom est obligatoire.',
            'Nom.regex' => 'Le champ Nom ne doit contenir que des lettres.',
            'prenom.required' => 'Le champ Prénom est obligatoire.',
            'prenom.regex' => 'Le champ Prénom ne doit contenir que des lettres.',
            'phone.required' => 'Le champ Téléphone est obligatoire.',
            'phone.digits' => 'Le champ Téléphone doit contenir exactement 9 chiffres.',
            'Email.required' => 'Le champ Email est obligatoire.',
            'Email.email' => 'Le champ Email doit être une adresse email valide.',
            'Email.unique' => 'Cette adresse email est déjà utilisée.',
            'MDP.required' => 'Le champ Mot de passe est obligatoire.',
            'MDP.min' => 'Le champ Mot de passe doit contenir au moins 8 caractères.',
            'MDP.confirmed' => 'Les mots de passe ne correspondent pas.',
            'role.required' => 'Le champ Profil est obligatoire.',
            'Etablissement.required_if' => 'Le champ Etablissement est obligatoire pour les professeurs.',
        ]);

        $user = new User();
        $user->nom = $request->input('Nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('Email');
        $user->password = bcrypt($request->input('MDP'));
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');
        $user->active = 1;
        $user->Etablissement = $request->input('role')=== 'professeur'? $request->input('Etablissement'): null;
        $user->save();
        $details = [
            'email' => $request->input('Email'),
            'password' => $request->input('MDP')
        ];

        Mail::to($user->email)->send(new UserMail($details));

        return redirect()->back()->with(['success' => 'Utilisateur ajouté avec succès.']);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with(['success' => 'Utilisateur supprimé avec succès']);
    }
    public function mesQuiz()
    {
        // Assurez-vous que l'utilisateur est connecté
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Récupérer les quiz du professeur connecté
    $user = Auth::user();
    $quizzes = Quiz::where('user', $user->id)
                    ->with('notes', 'professeur', 'matiere')
                    ->get();

    // Retourner la vue avec les données
    return view('les_quiz/Mes_quiz', compact('quizzes'));
    }
    public function AddTPstore(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'nomQuiz' => 'required|string|max:255',
            'matiere' => 'required|string|max:255',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string|max:255',
            'questions.*.reponses' => 'required|array|min:4',
            'questions.*.reponses.*.reponse' => 'required|string|max:255',
            'questions.*.reponses.*.is_correct' => 'required|boolean',
        ]);

        $quiz = quiz::create([
            'titre_quiz' => $request->nomQuiz,
            'user' => $request->id,
            'matiere' => $request->matiere,
        ]);

        foreach ($request->questions as $questionData) {
            $question = $quiz->question()->create([
                'contenu' => $questionData['question'],
            ]);

            foreach ($questionData['reponses'] as $reponseData) {
                $question->reponse()->create([
                    'reponse' => $reponseData['reponse'],
                    'status' => $reponseData['is_correct'],
                ]);
            }
        }

        return redirect()->back()->with(['success' => 'Utilisateur supprimé avec succès']);
    }
}
