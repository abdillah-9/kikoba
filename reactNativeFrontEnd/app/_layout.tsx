import { Stack, Navigator } from "expo-router";

export default function RootLayout() {
  return (
    <Stack>
      <Stack.Screen name="index" options={{ headerShown: false}} />
      <Stack.Screen name="signUp" options={{ headerTitle: ""}}/>
      <Stack.Screen name="SignIn" options={{ headerTitle: ""}}/>
      <Stack.Screen name="chooseService" options={{ headerTitle: ""}}/>
      <Stack.Screen name="adminService" options={{ headerTitle: ""}}/>
      <Stack.Screen name="viewBalance" options={{ headerTitle: ""}}/>
      <Stack.Screen name="contribute" options={{ headerTitle: ""}}/>
      <Stack.Screen name="receiveLoan" options={{ headerTitle: ""}}/>
      <Stack.Screen name="returnLoan" options={{ headerTitle: ""}}/>
    </Stack>
  );
}
