# Member Mobile App API Documentation

Base URL: `https://digital.feedtancmg.org/api`

---

## Authentication Overview
All endpoints return JSON responses.

### Response Format
```json
{
  "success": true|false,
  "message": "Description",
  "data": {}
}
```

---

## 1. Check Email
Check if an email is registered and its status.

**Endpoint**: `POST /api/member/check-email`

**Headers**:
- Content-Type: application/json

**Request Body**:
```json
{
  "email": "member@example.com"
}
```

**Responses**:

**Case 1: Email not registered**
```json
{
  "success": false,
  "message": "Email not found in system, please register first",
  "data": {
    "needs_registration": true
  }
}
```

**Case 2: Email found (PIN already set)**
```json
{
  "success": true,
  "message": "Email found",
  "data": {
    "needs_registration": false,
    "pin_is_set": true,
    "member": {
      "member_no": "M-2025-000001",
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+255712345678",
      "region": "Dar es Salaam",
      "branch": "Main",
      "membership_type": "Regular",
      "status": "Active",
      "joined_at": "2024-01-01T00:00:00Z",
      "passport_photo": "https://digital.feedtancmg.org/storage/..."
    }
  }
}
```

**Case 3: Email found (PIN not set - first time login)**
```json
{
  "success": true,
  "message": "Email found",
  "data": {
    "needs_registration": false,
    "pin_is_set": false,
    "member": { ... }
  }
}
```

---

## 2. First Time Login (Password → Set PIN)
For first time login (PIN not set yet). Verifies password and sets a new PIN.

**Endpoint**: `POST /api/member/login-first`

**Headers**:
- Content-Type: application/json

**Request Body**:
```json
{
  "email": "member@example.com",
  "password": "memberpassword123",
  "pin": "1234"
}
```

**Response (Success)**:
```json
{
  "success": true,
  "message": "PIN set and logged in successfully",
  "data": {
    "token": "1|abc123xyz...",
    "member": { ... }
  }
}
```

---

## 3. PIN Login
For subsequent logins (PIN already set).

**Endpoint**: `POST /api/member/login-pin`

**Headers**:
- Content-Type: application/json

**Request Body**:
```json
{
  "email": "member@example.com",
  "pin": "1234"
}
```

**Response (Success)**:
```json
{
  "success": true,
  "message": "Logged in successfully with PIN",
  "data": {
    "token": "1|abc123xyz...",
    "member": { ... }
  }
}
```

---

## 4. Member Registration
Register a new member.

**Endpoint**: `POST /api/member/register`

**Headers**:
- Content-Type: application/json

**Request Body**:
```json
{
  "name": "New Member",
  "email": "new@example.com",
  "password": "password123",
  "phone": "+255712345678",
  "nida": "1234567890",
  "gender": "Male",
  "dob": "1990-01-01",
  "marital_status": "Single",
  "occupation": "Engineer",
  "employer": "Company XYZ",
  "region": "Dar es Salaam",
  "district": "Ilala",
  "ward": "Mchafukoge",
  "street": "Samora Avenue",
  "po_box": "1234",
  "branch": "Main",
  "membership_type": "Regular",
  "next_of_kin_name": "Jane Doe",
  "next_of_kin_relationship": "Sister",
  "next_of_kin_phone": "+255711223344",
  "pin": "1234"
}
```

**Response (Success)**:
```json
{
  "success": true,
  "message": "Member registered successfully",
  "data": {
    "token": "1|abc123xyz...",
    "member": { ... }
  }
}
```

---

## 5. Get Dashboard Data
Get member dashboard details including balances and recent transactions. Requires authentication.

**Endpoint**: `GET /api/member/dashboard`

**Headers**:
- Content-Type: application/json
- Authorization: Bearer {token}

**Response (Success)**:
```json
{
  "success": true,
  "message": "Dashboard data retrieved successfully",
  "data": {
    "member": {
      "member_no": "M-2025-000001",
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "+255712345678",
      "region": "Dar es Salaam",
      "branch": "Main",
      "membership_type": "Regular",
      "status": "Active",
      "joined_at": "2024-01-01T00:00:00Z",
      "passport_photo": "https://digital.feedtancmg.org/storage/..."
    },
    "balances": {
      "total_savings": 2840000,
      "active_loans": 3270000,
      "loan_due": 327000,
      "shares": 0,
      "welfare": 0,
      "investments": 0
    },
    "recent_transactions": []
  }
}
```

---

## 6. Logout
Logout the member. Requires authentication token.

**Endpoint**: `POST /api/member/logout`

**Headers**:
- Content-Type: application/json
- Authorization: Bearer {token}

**Response (Success)**:
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

## Flutter App Implementation Flow

### Screen Flow:
1. Welcome/Splash Screen
2. Email Entry Screen
   → Call check-email endpoint
   → If needs_registration: Navigate to Registration Screen
   → Else if pin_is_set: Navigate to PIN Login Screen
   → Else (email found, no PIN): Navigate to First Time Login (Password → Set PIN)
3. Registration Screen
4. First Time Login (Password and Set PIN) Screen
5. PIN Login Screen (subsequent logins)
6. Home/Dashboard Screen (after login)
   → On load: Call GET /api/member/dashboard to fetch member data, balances, and transactions!

### Using Bearer Token in Flutter:
Add the Authorization header to all authenticated requests:
```dart
headers: {
  'Content-Type': 'application/json',
  'Authorization': 'Bearer $token'
}
```

---

## Notes for Web Admin
- Locking/unlocking member mobile access is done in Members Active page: /members/active
- Locked members will receive an access denied error if they try to login via mobile.
