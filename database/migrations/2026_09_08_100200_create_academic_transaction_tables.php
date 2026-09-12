<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->restrictOnDelete();
            $table->foreignId('subject_id')->constrained()->restrictOnDelete();
            $table->foreignId('classroom_id')->constrained()->restrictOnDelete();
            $table->foreignId('semester_id')->constrained()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['teacher_id', 'subject_id', 'classroom_id', 'semester_id'], 'teacher_assignment_unique');
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_assignment_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('day_of_week');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room')->nullable();
            $table->timestamps();
            $table->index(['day_of_week', 'start_time', 'end_time']);
        });

        Schema::create('attendance_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_assignment_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->unsignedSmallInteger('meeting_number');
            $table->string('topic')->nullable();
            $table->timestamps();
            $table->unique(['teacher_assignment_id', 'date']);
            $table->unique(['teacher_assignment_id', 'meeting_number']);
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendance_session_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->string('status', 10)->default('hadir');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->unique(['attendance_session_id', 'student_id']);
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_assignment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->restrictOnDelete();
            $table->decimal('assignment_score', 5, 2)->nullable();
            $table->decimal('midterm_score', 5, 2)->nullable();
            $table->decimal('final_exam_score', 5, 2)->nullable();
            $table->decimal('final_score', 5, 2)->nullable();
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->unique(['teacher_assignment_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('attendance_sessions');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('teacher_assignments');
    }
};
